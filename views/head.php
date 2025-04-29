<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reciπ</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="index.css">
    <link rel="icon" href="../images/icon.svg">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function getCookie(name) {
            return document.cookie
                .split('; ')
                .find(row => row.startsWith(name + '='))
                ?.split('=')[1];
        }

        let theme = getCookie("theme");
        if(!theme) {
            let themeSelection = getCookie("themeSelection");
            if(!themeSelection) {
                theme = (window.matchMedia("(prefers-color-scheme: dark)").matches)? "dark": "light";
                document.cookie = `themeSelection=default;  path=/`;
                document.cookie = `theme=${theme}; path=/`;
            } else {
                alert("THE CODE REACHES HERE");
                theme = themeSelection;
                if(themeSelection === "default") {
                    theme = (window.matchMedia("(prefers-color-scheme: dark)").matches)? "dark": "light";
                }
                document.cookie = `themeSelection=${themeSelection}; path=/`;
                document.cookie = `theme=${theme}; path=/`;
            }
        }
        document.documentElement.setAttribute("data-bs-theme", theme);
        
        function share() {
            const currentUrl = window.location.href;
            const textarea = document.createElement('textarea');
            textarea.value = currentUrl;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);

            alert("Link copied to clipboard!");
        }

        $(document).ready(function () {
            // template.php
            const themeSelection = getCookie("themeSelection");
            $(`.${themeSelection}-dropdown-item`).addClass("active");

            $(document).ready(function () {
                $(".theme-dropdown-item ").click(function () {
                    const themeSelection = $(this).data("selection");

                    $(".theme-dropdown-item").removeClass("active");
                    $(`.${themeSelection}-dropdown-item`).addClass("active");

                    let theme = themeSelection;
                    if(themeSelection === "default") {
                        theme = (window.matchMedia("(prefers-color-scheme: dark)").matches)? "dark": "light";
                    }

                    document.cookie = `themeSelection=${themeSelection}; path=/`;
                    document.cookie = `theme=${theme}; path=/`;
                    document.documentElement.setAttribute("data-bs-theme", theme);
                });
            });
        });
    </script>
</head>
