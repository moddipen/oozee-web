$(function() {
	let FADE_TIME = 150; // ms
	let TYPING_TIMER_LENGTH = 400; // ms
	let COLORS = [
		'#e21400', '#91580f', '#f8a700', '#f78b00',
		'#58dc00', '#287b00', '#a8f07a', '#4ae8c4',
		'#3b88eb', '#3824aa', '#a700ff', '#d300e7'
	];

	// Initialize letiables
	let $window = $(window);
	let $usernameInput = $('.usernameInput'); // Input for username
	let $messages = $('.messages'); // Messages area
	let $inputMessage = $('.inputMessage'); // Input message input box
	let $senderId = $('.senderId'); // Sender ID
	let $receiverId = $('.receiverId'); // Receiver ID

	let $loginPage = $('.login.page'); // The login page
	let $chatPage = $('.chat.page'); // The chatroom page

	// Prompt for setting a username
	let username;
	let connected = false;
	let typing = false;
	let lastTypingTime;
	let $currentInput = $usernameInput.focus();

	let socket = io();

	function addParticipantsMessage (data) {
		let message = '';
		if (data.connectedUsers === 1) {
			message += "there's 1 participant";
		} else {
			message += "there are " + data.connectedUsers + " participants";
		}
		log(message);
	}

	// Sets the client's username
	function setUsername () {
		username = cleanInput($usernameInput.val().trim());

		// If the username is valid
		if (username) {
			$loginPage.fadeOut();
			$chatPage.show();
			$loginPage.off('click');
			$currentInput = $inputMessage.focus();

			// Tell the server your username
			socket.emit('add user', username);

			socket.emit('room', getUserData());
		}
	}

	/**
	 * Get user data
	 */
	function getUserData() {
		let senderID = $senderId.val();
		let receiverID = $receiverId.val();
		let sid = parseInt(senderID)
		let rid = parseInt(receiverID)
		return {
			sender: sid,
			receiver: rid
		}
	}

	// Sends a chat message
	function sendMessage () {
		let message = $inputMessage.val();
		let senderID = $senderId.val();
		let receiverID = $receiverId.val();
		// Prevent markup from being injected into the message
		message = cleanInput(message);
		// if there is a non-empty message and a socket connection
		if (message) {
			$inputMessage.val('');
			// addChatMessage({
			// 	username: username,
			// 	message: message
			// });
			let sid = parseInt(senderID)
			let rid = parseInt(receiverID)
			let data = {
				message: message,
				sender: sid,
				receiver: rid
			}
			// tell server to execute 'new message' and send along one parameter
			socket.emit('new message', data);
		}
	}

	// Log a message
	function log (message, options) {
		let $el = $('<li>').addClass('log').text(message);
		addMessageElement($el, options);
	}

	// Adds the visual chat message to the message list
	function addChatMessage (data, options) {
		// Don't fade the message in if there is an 'X was typing'
		let $typingMessages = getTypingMessages(data);
		options = options || {};
		if ($typingMessages.length !== 0) {
			options.fade = false;
			$typingMessages.remove();
		}

		let $usernameDiv = $('<span class="username"/>')
			.text(data.username)
			.css('color', getUsernameColor(data.username));
		let $messageBodyDiv = $('<span class="messageBody">')
			.text(data.message);

		let typingClass = data.typing ? 'typing' : '';
		let $messageDiv = $('<li class="message"/>')
			.data('username', data.username)
			.addClass(typingClass)
			.append($usernameDiv, $messageBodyDiv);

		addMessageElement($messageDiv, options);
	}

	// Adds the visual chat typing message
	function addChatTyping (data) {
		data.typing = true;
		data.message = 'is typing';
		addChatMessage(data);
	}

	// Removes the visual chat typing message
	function removeChatTyping (data) {
		getTypingMessages(data).fadeOut(function () {
			$(this).remove();
		});
	}

	// Adds a message element to the messages and scrolls to the bottom
	// el - The element to add as a message
	// options.fade - If the element should fade-in (default = true)
	// options.prepend - If the element should prepend
	//   all other messages (default = false)
	function addMessageElement (el, options) {
		let $el = $(el);

		// Setup default options
		if (!options) {
			options = {};
		}
		if (typeof options.fade === 'undefined') {
			options.fade = true;
		}
		if (typeof options.prepend === 'undefined') {
			options.prepend = false;
		}

		// Apply options
		if (options.fade) {
			$el.hide().fadeIn(FADE_TIME);
		}
		if (options.prepend) {
			$messages.prepend($el);
		} else {
			$messages.append($el);
		}
		$messages[0].scrollTop = $messages[0].scrollHeight;
	}

	// Prevents input from having injected markup
	function cleanInput (input) {
		return $('<div/>').text(input).html();
	}

	// Updates the typing event
	function updateTyping () {
		let uData = getUserData()
		if (connected) {
			if (!typing) {
				typing = true;
				socket.emit('typing', uData);
			}
			lastTypingTime = (new Date()).getTime();

			setTimeout(function () {
				let typingTimer = (new Date()).getTime();
				let timeDiff = typingTimer - lastTypingTime;
				if (timeDiff >= TYPING_TIMER_LENGTH && typing) {
					socket.emit('stop typing', uData);
					typing = false;
				}
			}, TYPING_TIMER_LENGTH);
		}
	}

	// Gets the 'X is typing' messages of a user
	function getTypingMessages (data) {
		return $('.typing.message').filter(function (i) {
			return $(this).data('username') === data.username;
		});
	}

	// Gets the color of a username through our hash function
	function getUsernameColor (username) {
		// Compute hash code
		let hash = 7;
		for (let i = 0; i < username.length; i++) {
			hash = username.charCodeAt(i) + (hash << 5) - hash;
		}

		// Calculate color
		let index = Math.abs(hash % COLORS.length);
		return COLORS[index];
	}

	// Keyboard events

	$window.keydown(function (event) {
		// Auto-focus the current input when a key is typed
		if (!(event.ctrlKey || event.metaKey || event.altKey)) {
			// $currentInput.focus();
		}
		// When the client hits ENTER on their keyboard
		if (event.which === 13) {
			if (username) {
				sendMessage();
				let uData = getUserData()
				socket.emit('stop typing', uData);
				typing = false;
			} else {
				setUsername();
			}
		}
	});

	$inputMessage.on('input', function() {
		updateTyping();
	});

	// Click events

	// Focus input when clicking anywhere on login page
	$loginPage.click(function () {
		$currentInput.focus();
	});

	// Focus input when clicking on the message input's border
	$inputMessage.click(function () {
		$inputMessage.focus();
	});

	// Socket events

	// Whenever the server emits 'login', log the login message
	socket.on('login', function (data) {
		connected = true;
		// Display the welcome message
		let message = "Welcome to Socket.IO Chat – ";
		log(message, {
			prepend: true
		});
		addParticipantsMessage(data);
	});

	// Whenever the server emits 'new message', update the chat body
	socket.on('newmessage', function (data) {
		addChatMessage(data);
	});

	// Whenever the server emits 'user joined', log it in the chat body
	socket.on('user joined', function (data) {
		log(data.username + ' joined');
		addParticipantsMessage(data);
	});

	// Whenever the server emits 'user left', log it in the chat body
	socket.on('user left', function (data) {
		log(data.username + ' left');
		addParticipantsMessage(data);
		removeChatTyping(data);
	});

	// Whenever the server emits 'typing', show the typing message
	socket.on('typing', function (data) {
		addChatTyping(data);
	});

	// Whenever the server emits 'stop typing', kill the typing message
	socket.on('stop typing', function (data) {
		removeChatTyping(data);
	});

	socket.on('room messages', function (data) {
		console.log(data)
	});

	socket.on('disconnect', function () {
		log('you have been disconnected');
	});

	socket.on('reconnect', function () {
		log('you have been reconnected');
		if (username) {
			socket.emit('add user', username);
		}
	});

	socket.on('reconnect_error', function () {
		log('attempt to reconnect has failed');
	});

});