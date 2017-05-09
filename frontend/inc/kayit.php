<?php echo !defined("GUVENLIK") ? die("Geçersiz istek") : null; ?>
<div class="banner-form">
  <h4>Kayıt Ol</h4>
  <p>Proje göndermek için bir kaydınız olması gerekir.</p>
  <form action="#" id="kayit">
    <div class="form-group" id="numara">
      <input type="number" class="form-control" id="okul_no" maxlength="20" min="0" placeholder="Okul Numaranız" required>
      <p class="help-block text-danger"></p>
    </div>
    <div class="form-group">
      <input type="text" class="form-control" id="adiniz" maxlength="50" placeholder="Adınız" required>
      <p class="help-block"></p>
    </div>
    <div class="form-group">
      <input type="email" class="form-control" id="eposta" maxlength="75" placeholder="E-posta" required>
      <p class="help-block"></p>
    </div>
    <button type="submit" class="btn btn-info btn-block btn-lg">İstek Gönder</button>
  </form>
</div>