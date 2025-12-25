<!--/ Layout Demo -->
</div>
<!-- / Content -->

<!-- Footer -->
<footer class="content-footer footer bg-footer-theme">
    <div class="container-xxl">
        <div class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column">
            <div>
                © {{ date('Y') }} , {{ trans('admin.Created & Developed by') }} <a
                    href="https://www.linkedin.com/in/engmohsenit" target="_blank" class="fw-medium">Ahmed Mohsen</a>
            </div>

        </div>
    </div>
</footer>
<!-- / Footer -->

<div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
</div>
<!-- / Layout page -->
</div>

<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>

<!-- Drag Target Area To SlideIn Menu On Small Screens -->
<div class="drag-target"></div>
</div>
<!-- / Layout wrapper -->

<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->

<script src="{{ asset('dashboard') }}/assets/vendor/libs/jquery/jquery.js"></script>
<script src="{{ asset('dashboard') }}/assets/vendor/libs/popper/popper.js"></script>
<script src="{{ asset('dashboard') }}/assets/vendor/js/bootstrap.js"></script>
<script src="{{ asset('dashboard') }}/assets/vendor/libs/node-waves/node-waves.js"></script>
<script src="{{ asset('dashboard') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="{{ asset('dashboard') }}/assets/vendor/libs/hammer/hammer.js"></script>
{{-- <script src="{{ asset('dashboard') }}/assets/vendor/libs/i18n/i18n.js"></script> --}}
<script src="{{ asset('dashboard') }}/assets/vendor/libs/typeahead-js/typeahead.js"></script>
<script src="{{ asset('dashboard') }}/assets/vendor/js/menu.js"></script>

<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{ asset('dashboard') }}/assets/vendor/libs/select2/select2.js"></script>
<script src="{{ asset('dashboard') }}/assets/js/forms-selects.js"></script>
<script src="{{ asset('dashboard') }}/assets/vendor/libs/dropzone/dropzone.js"></script>
<script src="{{ asset('dashboard') }}/assets/js/forms-file-upload.js"></script>

<!-- Main JS -->
<script src="{{ asset('dashboard') }}/assets/js/main.js"></script>

<script>
    $(document).ready(function() {
        $("#enLang").click(function(e) {
            e.preventDefault();
            localStorage.setItem('templateCustomizer-vertical-menu-template--Rtl', false);
            window.location.href = "{{ aurl('settings/language/en') }}";
        })
        $("#arLang").click(function(e) {
            e.preventDefault();
            localStorage.setItem('templateCustomizer-vertical-menu-template--Rtl', true);
            window.location.href = "{{ aurl('settings/language/ar') }}";
        })
    });
</script>

@stack('script')
<!-- Page JS -->
</body>

</html>
