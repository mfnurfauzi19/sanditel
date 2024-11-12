<?= $this->session->flashdata('pesan'); ?>

<div class="container-fluid">
    <!-- Sidebar Menu -->
    <div class="row">
        <div>
           
        </div>
        
        <!-- Main Content -->
        <div class="col-md-10">
            <h3>Form Pengisian Berdasarkan Kategori</h3>
            <hr>

            <!-- Dropdown untuk memilih kategori -->
            <form id="kategoriForm" method="POST" action="<?= base_url('dataasset/submit_form') ?>">
                <div class="form-group">
                    <label for="kategori">Pilih Kategori</label>
                    <select id="kategori" name="kategori" class="form-control" onchange="tampilkanForm(this)">
                        <option value="">Pilih Kategori</option>
                        <?php foreach ($kategori as $kat): ?>
                            <option value="<?= $kat['kategori'] ?>"><?= $kat['kategori'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Tempat untuk menampilkan form dinamis -->
                <div id="dynamicForm"></div>

                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>
        </div>
    </div>
</div>

<script>
// Fungsi untuk menampilkan form sesuai dengan kategori yang dipilih
function tampilkanForm(selectElement) {
    var kategori = selectElement.value;
    var formContainer = document.getElementById("dynamicForm");

    // Clear previous form
    formContainer.innerHTML = "";

    if (kategori != "") {
        // Simulasikan jumlah item berdasarkan kategori (misalnya, 3 item untuk kategori ini)
        var jumlahItem = 3;  // Anda bisa mengganti ini berdasarkan data kategori dari server

        for (var i = 1; i <= jumlahItem; i++) {
            var formField = document.createElement("div");
            formField.classList.add("form-group");
            formField.innerHTML = `
                <label for="item${i}">Item ${i}</label>
                <input type="text" name="item${i}" class="form-control" placeholder="Masukkan data untuk item ${i}">
            `;
            formContainer.appendChild(formField);
        }
    }
}
</script>
