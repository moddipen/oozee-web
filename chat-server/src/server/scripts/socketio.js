let isTokenValid = (token) => {
    //authenticat encryption or user record in database
    return true;
};
/** letiables */
let connectedUsers = 0;
const mysql = require('mysql');

/** DB connections */
const con = mysql.createConnection({
    host: process.env.DB_HOST,
    user: process.env.DB_USERNAME,
    password: process.env.DB_PASSWORD,
    database: process.env.DB_DATABASE
});
/** end DB connections */

setRoom = (data) => {
    let dd = JSON.parse(data);
    let room = 'room#'
    if (dd.sender > dd.receiver) {
        room += dd.receiver + '#' + dd.sender
    } else {
        room += dd.sender + '#' + dd.receiver
    }
    return room
}

module.exports = (server) => {

    let io = require('socket.io')(server);

    // middleware to verify on Connecting and Reconnecting
    io.use((socket, next) => {
        let token = socket.handshake.query.token;
        if (true || isTokenValid(token)) {
            return next();
        }
        return next(new Error('authentication error'));
    });

    io.on('connection', (socket) => {
        let addedUser = false;

        socket.on('room', function (data) {
            let room = setRoom(data)
            let dd = JSON.parse(data);
            console.log(dd)
            console.log('room create')
            socket.join(room);

            let messages = [];
            let reads = [];
            con.query("SELECT * FROM messages WHERE (sender_id = " + dd.sender + " AND receiver_id = " + dd.receiver + ") OR (sender_id = " + dd.receiver + " AND receiver_id = " + dd.sender + ") ORDER BY id DESC", (err, result, fields) => {
                if (err) throw err;
                messages = result
            });

            con.query("SELECT * FROM message_reads WHERE user_id = " + dd.receiver + " AND room = '" + room + "' ORDER BY id DESC LIMIT 1", (err, result, fields) => {
                if (err) throw err;
                reads = result
            });

            setTimeout(() => {
                console.log(messages, reads, room);
                io.sockets.in(room).emit('room', {
                    data: {
                        messages: messages,
                        reads: reads,
                        room: room
                    }
                });
            }, 500);
        });

        // when the client emits 'new message', this listens and executes
        socket.on('new message', (data) => {
            let room = setRoom(data)

            let dd = JSON.parse(data);
            console.log(dd)
            // we tell the client to execute 'new message'
            io.sockets.in(room).emit('new message', {
                username: socket.username,
                message: dd.message
            });

            let sql = "INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)";
            let values = [dd.sender, dd.receiver, dd.message];
            con.query(sql, values, (err, result) => {
                if (err) throw err;
                /*Use the result object to get the id:*/
                console.log("1 message inserted, ID: " + result.insertId);
            });
        });

        // when the client emits 'add user', this listens and executes
        socket.on('add user', (username) => {
            if (addedUser) return;
            // we store the username in the socket session for this client
            socket.username = username;
            ++connectedUsers;
            addedUser = true;
            socket.emit('login', {
                connectedUsers: connectedUsers
            });
            // echo globally (all clients) that a person has connected
            socket.broadcast.emit('user joined', {
                username: socket.username,
                connectedUsers: connectedUsers
            });
        });

        // when the client emits 'message read', this listens and executes
        socket.on('message read', (data) => {
            let dd = JSON.parse(data);

            con.query("DELETE FROM message_reads WHERE user_id="+dd.user_id+" AND room="+dd.room,(err, result) => {
                if (err) throw err;

                let sql = "INSERT INTO message_reads (user_id, room, message_id, read_at) VALUES (?, ?, ?, ?)";
                let values = [dd.user_id, dd.room, dd.message_id, dd.read_at];
                con.query(sql, values, (err, result) => {
                    if (err) throw err;
                    con.query("SELECT * FROM message_reads WHERE user_id = " + dd.user_id + " AND room = '" + dd.room + "' ORDER BY id DESC LIMIT 1", (err, result, fields) => {
                        if (err) throw err;
                        io.sockets.in(dd.room).emit('message read', {
                            data: {
                                reads: result
                            }
                        });
                    });
                    /*Use the result object to get the id:*/
                    // console.log("1 record inserted, ID: " + result.insertId);
                });
            });
        });

        // when the client emits 'typing', we broadcast it to others
        socket.on('typing', (data) => {
            let room = setRoom(data)
            io.sockets.in(room).emit('typing', {
                username: socket.username
            });
        });

        // when the client emits 'stop typing', we broadcast it to others
        socket.on('stop typing', (data) => {
            let room = setRoom(data)
            io.sockets.in(room).emit('stop typing', {
                username: socket.username
            });
        });

        // when the user disconnects.. perform this
        socket.on('disconnect', () => {
            if (addedUser) {
                --connectedUsers;

                // echo globally that this client has left
                socket.broadcast.emit('user left', {
                    username: socket.username,
                    connectedUsers: connectedUsers
                });
            }
        });
    });
}