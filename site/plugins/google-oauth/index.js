if (window.panel) {
    var oauthBasePath = window.panel.site + "/oauth";
    var url = window.location + "";

    // override to login screen
    if (url.indexOf(window.panel.url) === 0) {
        var url = null;
        var tryCounter = 0;


        var updateForm = function () {
            tryCounter++;

            var form = document.getElementsByClassName("k-login-form").item(0);

            if (tryCounter > 10) {
                return;
            }

            if (!form) {
                setTimeout(function () {
                    updateForm()
                }, 200);
                return;
            }

            form.insertAdjacentHTML('beforeend', '<a class="login-btn login-btn-google" href="'+url["redirect"]+'">Mit Google-Konto anmelden</a>');

            return;
        }

        fetch(oauthBasePath + "/url")
            .then(response => response.json())
            .then(function (urlData) {
                url = urlData;
                updateForm();
            });
    }
}