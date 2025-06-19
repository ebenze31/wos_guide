<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>THV Guide</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{ asset('theme/assets/favicon.png') }}" />
        <!-- Custom Google font-->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('theme/css/styles.css') }}" rel="stylesheet" />
    </head>
    <body class="d-flex flex-column h-100">
        <main class="flex-shrink-0">
            <!-- Navigation-->
            <nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
                <div class="container px-5">
                    <img class="profile-img d-none d-lg-block" src="{{ url('/theme/img/logo/thv_logo.png') }}" style="width:8%;">
                    <img class="profile-img d-block d-md-none" src="{{ url('/theme/img/logo/thv_logo.png') }}" style="width:22%;">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 small fw-bolder">
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:trocarIdioma('th')">TH</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:trocarIdioma('en')">EN</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Header-->
            <header class="py-5">
                <div class="container px-5 pb-5">
                    <div class="row gx-5 align-items-center">
                        @yield('content')
                    </div>
                </div>
            </header>
        </main>
        <!-- Footer-->
        <footer class="mt-auto bg-light py-2" style="border-top: 1px solid #606060;">
            <div class="container px-5 d-none d-lg-block">
                <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                    <div class="col-auto">
                        <div class="small m-0">#Chinchilla DEV</div>
                    </div>
                    <div class="col-auto">
                        <div style="display: none;" id="google_translate_element"></div>
                    </div>
                    <div class="col-auto">
                        <span class="small">#THV 1692</span>
                    </div>
                </div>
            </div>

            <div class="container px-5 d-block d-md-none">
                <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                    <div class="col-auto text-center">
                        <span class="small m-0">#Chinchilla DEV</span>
                        <span class="small">#THV 1692</span>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('theme/js/scripts.js') }}"></script>

        <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
        <script type="text/javascript">
            let comboGoogleTradutor = null;

            function googleTranslateElementInit() {
                new google.translate.TranslateElement({
                    pageLanguage: 'en',
                    includedLanguages: 'th,en,zh-CN,ja,ko',
                    layout: google.translate.TranslateElement.InlineLayout.SIMPLE
                }, 'google_translate_element');

                // เรียกหลังสร้างเสร็จแน่นอน
                setTimeout(setTranslatorCombo, 1000); // รอ 1 วินาทีให้ iframe แสดงก่อน
            }


            function setTranslatorCombo() {
                const interval = setInterval(() => {
                    const iframe = document.querySelector("iframe.goog-te-menu-frame");
                    if (iframe) {
                        const innerDoc = iframe.contentDocument || iframe.contentWindow.document;
                        const select = innerDoc.querySelector("select.goog-te-combo");
                        if (select) {
                            comboGoogleTradutor = select;
                            clearInterval(interval);
                        }
                    }
                }, 500);
            }

            function changeEvent(el) {
                if (el.fireEvent) {
                    el.fireEvent('onchange');
                } else {
                    const evObj = document.createEvent("HTMLEvents");
                    evObj.initEvent("change", false, true);
                    el.dispatchEvent(evObj);
                }
            }

            function trocarIdioma(lang) {
                const tryChange = () => {
                    if (comboGoogleTradutor) {
                        comboGoogleTradutor.value = lang;
                        changeEvent(comboGoogleTradutor);
                    } else {
                        // ยังไม่เจอ select -> ลองใหม่ทุก 500ms
                        setTimeout(tryChange, 500);
                    }
                };
                tryChange();
            }


        </script>
        <script>
            setTranslatorCombo(); // เรียกหลังโหลด Google Translate
        </script>
    </body>
</html>
