<?php echo !defined("GUVENLIK") ? die("Geçersiz istek") : null; ?>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" style="outline: 0" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="outline: 0">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Giriş Yap</h4>
            </div>
            <form action="#" id="giris">
                <p class="text-danger text-center" style="margin-top: 10px;margin-bottom: -10px;"  id="hata"></p>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="okul_no">Okul Numaranız</label>
                        <input type="number" name="okul_no" id="g_okul_no" min="0" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="sifre">Şifreniz</label>
                        <input type="password" name="sifre" id="g_sifre" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Vazgeç</button>
                    <button type="submit" class="btn btn-primary">Giriş Yap</button>
                </div>
            </form>
        </div>
    </div>
</div>