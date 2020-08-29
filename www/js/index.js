var form = $('.form')

var nameInput = $('#nameInput')
var emailInput = $('#emailInput')
var messageInput = $('#messageInput')

$('.form .btn').on('click', function() {
	// Reset errors
	nameInput.parent().removeClass('has-error')
	nameInput.parent().find('.help-block').hide()
	emailInput.parent().removeClass('has-error')
	emailInput.parent().find('.help-block').hide()
	messageInput.parent().removeClass('has-error')
	messageInput.parent().find('.help-block').hide()


	// Validate form data
	let has_error = false
	if(nameInput.val().trim().length === 0) {
		nameInput.parent().addClass('has-error')
		nameInput.parent().find('.help-block').text('Enter your name')
		nameInput.parent().find('.help-block').show()
		nameInput.val('')
		has_error = true
	}

	if(emailInput.val().trim().length === 0) {
		emailInput.parent().addClass('has-error')
		emailInput.parent().find('.help-block').text('Enter your email address')
		emailInput.parent().find('.help-block').show()
		emailInput.val('')
		has_error = true
	}

	if(messageInput.val().trim().length === 0) {
		messageInput.parent().addClass('has-error')
		messageInput.parent().find('.help-block').text('Write your message')
		messageInput.parent().find('.help-block').show()
		messageInput.val('')
		has_error = true
	}

	if(has_error) return

	axios.post('/feedback.php', 'name=' + nameInput.val() + '&email=' + emailInput.val() + '&message=' + messageInput.val(), {
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8',
		},
	})
		.then(function(response) {
			if(response.status === 201 && response.data === 'Created') {
				$('.form').hide()
				$('.alert').html('Thanks, <b>' + nameInput.val().trim().charAt(0).toUpperCase() + nameInput.val().trim().slice(1).toLowerCase() + '!</b>')
				$('.alert').fadeIn(500)

				setTimeout(function() {
					$('.form').show()
					$('.alert').hide()

					nameInput.val('')
					emailInput.val('')
					messageInput.val('')
				}, 5000)
			}
		})
		.catch(function(error) {
			if(error.response) {
				var response = error.response

				if(response.status === 400) {
					if(response.data === 'Email format') {
						emailInput.parent().addClass('has-error')
						emailInput.parent().find('.help-block').text('Enter a valid email address')
						emailInput.parent().find('.help-block').show()
						has_error = true
					}
				}
			} else {
				alert('Error')
			}
		})
})

