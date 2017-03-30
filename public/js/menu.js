
$(function(){
  getActiveMenu();
});

function getActiveMenu(){
  var add = window.location.href;

  if (add.search('gudang/stok') > 0) {
    $('#gudang').addClass('active');
    $('#stok').addClass('active');
  }else if (add.search('gudang/gabah') > 0) {
    $('#gudang').addClass('active');
    $('#gabah').addClass('active');
  }else if (add.search('gudang/jemurgabah') > 0) {
    $('#gudang').addClass('active');
    $('#gabah').addClass('active');
  }else if (add.search('gudang/giling') > 0) {
    $('#gudang').addClass('active');
    $('#gabah').addClass('active');
  }else if (add.search('gudang/beras') > 0) {
    $('#gudang').addClass('active');
    $('#beras').addClass('active');
  }else if (add.search('gudang/beliberas') > 0) {
    $('#gudang').addClass('active');
    $('#berasbeli').addClass('active');
  }else if (add.search('gudang/sekam') > 0) {
    $('#gudang').addClass('active');
    $('#sekam').addClass('active');
  }else if(add.search('gudang/dedak') > 0){
    $('#gudang').addClass('active');
    $('#dedak').addClass('active');
  }else if (add.search('/penjualan') > 0) {
    $('#penjualan').addClass('active');
  }else if (add.search('/kepegawaian/pegawai') > 0) {
    $('#kepegawaian').addClass('active');
    $('#pegawai').addClass('active');
  }else if (add.search('/kepegawaian/absen') > 0) {
    $('#kepegawaian').addClass('active');
    $('#absensi').addClass('active');
  }else if (add.search('/kepegawaian/penggajian') > 0) {
    $('#kepegawaian').addClass('active');
    $('#penggajian').addClass('active');
  }else if (add.search('/profile') > 0) {
    $('#gudang').addClass('active');
  }else if (add.search('/users') > 0) {
    $('#users').addClass('active');

  }

}
