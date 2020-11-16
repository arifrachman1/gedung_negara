
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Gedung Negara 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Yakin ingin Keluar?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Pilih "Keluar" di bawah ini jika Anda siap untuk mengakhiri sesi Anda saat ini.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
          <a class="btn btn-danger" href="{{ route('logout') }}">Keluar</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('style/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('style/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('style/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('style/js/sb-admin-2.min.js') }}"></script>

  <!-- Page level plugins -->
  <script src="{{ asset('style/vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('style/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('style/js/demo/datatables-demo.js') }}"></script>

  <!-- Kalkulasi klasifikasi kerusakan -->
  <!-- <script src="{{ asset('style/js/kalkulasi-kerusakan.js') }}"></script> -->

</body>

</html>
