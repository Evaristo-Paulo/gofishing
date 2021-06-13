var form = document.querySelectorAll('.modalSendForm');
if (form) {
    form.forEach((v, i) => {
        form[i].addEventListener('submit', (e) => {
            e.preventDefault()

            var url = form[i].dataset.url;
            var method = form[i].dataset.method;
            var formData = new FormData(form[i]);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: method,
                dataType: "JSON",
                contentType: false, // requires jQuery 1.6+
                processData: false,
                data: formData,
                beforeSend: function () {
                    console.log('Carregando o loading ...');
                    document.querySelectorAll('.custom-loader')[i].style.display = 'block'
                },
                success: function (response) {
                    console.log(response);
                    document.querySelectorAll('.custom-loader')[i].style.display = 'none'
                    document.querySelectorAll('.alert-success')[i].style.display = 'block'
                    setTimeout(() => {
                        $(".modalSendForm")[i].reset();
                        document.querySelectorAll('.alert-success')[i].style.display = 'none'
                    }, 3000);
                },
                error: function (data) {
                    console.log('Error: ', data)
                    document.querySelectorAll('.custom-loader')[i].style.display = 'none'
                    document.querySelectorAll('.alert-danger' )[i].style.display = 'block'
                    setTimeout(() => {
                        document.querySelectorAll('.alert-danger')[i].style.display = 'none'
                    }, 3000);
                }
            });
        })

    })
}
