<form id="contactForm" method="post" action="">
    <div class="form-group">
        <label for="name">Adınız:</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="form-group">
        <label for="email">E-posta Adresiniz:</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="form-group">
        <label for="subject">Konu:</label>
        <input type="text" class="form-control" id="subject" name="subject" required>
    </div>
    <div class="form-group">
        <label for="message">Açıklama:</label>
        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Gönder</button>
</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#contactForm').submit(function(e) {
        e.preventDefault();

        var form = $(this);
        var url = '/mail/contact/index';


        $.ajax({
            type: 'POST',
            url: url,
            data: form.serialize(),
            dataType: 'json',
            success: function(response) {
                $('#responseMessage').removeClass().addClass('alert').addClass('alert-' + response.status).text(response.message);
                form.trigger('reset');
            },
            error: function() {
                $('#responseMessage').removeClass().addClass('alert').addClass('alert-danger').text('Bir hata oluştu. Lütfen daha sonra tekrar deneyin.');
            }
        });
    });
});

</script>






<div id="responseMessage"></div>
