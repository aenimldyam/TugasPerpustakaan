<?php

namespace App\Controllers;

use App\Controllers\BaseController;
// Import Model M_admin
use App\Models\M_admin;
// Import Model M_buku
use App\Models\M_buku;
use App\Models\M_kategori;
use App\Models\M_rak;
use CodeIgniter\HTTP\ResponseInterface;
// use App\Models\adminModels;

class Admin extends BaseController
{
    public function login()
    {
        return view('Backend/Login/login');
    }

    // public function dashboard()
    // {
    //     echo view('backend/template/header');
    //     echo view('backend/template/sidebar');
    //     echo view('backend/login/dashboard_admin');
    //     echo view('backend/template/footer');
    // }

    public function dashboard()
    {
        $modelBuku = new M_buku;
        $modelKategori = new M_kategori;
        $modelRak = new M_rak;

        $data['total_buku'] = count(
            $modelBuku->getDataBuku()->getResultArray()
        );

        $data['total_kategori'] = count(
            $modelKategori->getDataKategori()->getResultArray()
        );

        $data['total_rak'] = count(
            $modelRak->getDataRak()->getResultArray()
        );

        $data['total_anggota'] = 0;

        echo view('Backend/Template/header', $data);
        echo view('Backend/Template/sidebar', $data);
        echo view('Backend/Login/dashboard_admin', $data);
        echo view('Backend/Template/footer', $data);
    }

    public function autentikasi()
    {
        $modelAdmin = new M_admin();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $cekUsername = $modelAdmin->getDataAdmin([
            'username_admin' => $username,
            'is_delete_admin' => '0'
        ])->getNumRows();

        if ($cekUsername == 0) {
            session()->setFlashdata('error', 'Username Tidak Ditemukan!');
            return redirect()->back(); // Cara lebih rapi daripada menggunakan JS history.go
        } else {
            $dataUser = $modelAdmin->getDataAdmin([
                'username_admin' => $username,
                'is_delete_admin' => '0'
            ])->getRowArray();

            $passwordUser = $dataUser['password_admin'];

            if (!password_verify($password, $passwordUser)) {
                session()->setFlashdata('error', 'Password Tidak Sesuai!');
                return redirect()->back();
            } else {
                $dataSession = [
                    'ses_id'    => $dataUser['id_admin'],
                    'ses_user'  => $dataUser['nama_admin'],
                    'ses_level' => $dataUser['akses_level'],
                    'logged_in' => true
                ];

                session()->set($dataSession);
                session()->setFlashdata('success', 'Login Berhasil!');

                return redirect()->to(base_url('admin/dashboard-admin'));
            }
        }
    }

    public function logout(){
        session()->remove('ses_id');
        session()->remove('ses_user');
        session()->remove('ses_level');
        session()->setFlashdata('info','Anda telah keluar dari sistem!');
        ?>
        <script>
            document.location = "<?= base_url('admin/login-admin');?>";
        </script>
        <?php
    }
    
    // =========================
    // ADMIN
    // =========================
    public function input_data_admin(){
        if(session()->get('ses_id')==="" or session()->get('ses_user')==="" or session()->get('ses_level')===""){
            session()->setFlashdata('error','Silakan login terlebih dahulu!');
            ?>
            <script>
                document.location = "<?= base_url('admin/login-admin');?>";
            </script>
            <?php
        }
        else{
            echo view('Backend/Template/header');
            echo view('Backend/Template/sidebar');
            echo view('Backend/MasterAdmin/input-admin');
            echo view('Backend/Template/footer');
        }
    }
    public function simpan_data_admin(){
    if(session()->get('ses_id')==="" or session()->get('ses_user')==="" or session()->get('ses_level')===""){
        session()->setFlashdata('error','Silakan login terlebih dahulu!');
        ?>
        <script>
            document.location = "<?= base_url('admin/login-admin');?>";
        </script>
        <?php
    }
    else{
        $modelAdmin = new M_admin; // inisiasi

        $nama = $this->request->getPost('nama');
        $username = $this->request->getPost('username');
        $level = $this->request->getPost('level');

        $cekUname = $modelAdmin->getDataAdmin(['username_admin' => $username])->getNumRows();
        if($cekUname > 0){
            session()->setFlashdata('error','Username sudah digunakan!!');
            ?>
            <script>
                history.go(-1);
            </script>
            <?php
        }
        else{
            $hasil = $modelAdmin->autoNumber()->getRowArray();
            if(!$hasil){
                $id = "ADM001";
            }
            else{
                $kode = $hasil['id_admin'];
                $noUrut = (int) substr($kode, -3);
                $noUrut++;
                $id = "ADM".sprintf("%03s", $noUrut);
            }

            $dataSimpan = [
                'id_admin'       => $id,
                'nama_admin'     => $nama,
                'username_admin' => $username,
                'password_admin' => password_hash('pass_admin', PASSWORD_DEFAULT),
                'akses_level'    => $level,
                'is_delete_admin'=> '0',
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s')
            ];
                $modelAdmin->saveDataAdmin($dataSimpan);
                session()->setFlashdata('success', 'Data Admin Berhasil Ditambahkan!!');
                ?>
                <script>
                    document.location = "<?= base_url('admin/master-data-admin');?>";
                </script>
                <?php
            }
        }
    }
    public function master_data_admin(){
        if(session()->get('ses_id')==="" or session()->get('ses_user')==="" or session()->get('ses_level')===""){
            session()->setFlashdata('error','Silakan login terlebih dahulu!');
            ?>
            <script>
                document.location = "<?= base_url('admin/login-admin');?>";
            </script>
            <?php
        }
        else{
            $modelAdmin = new M_admin; // inisiasi

            $uri = service('uri');
            $pages = $uri->getSegment(2);
            $dataUser = $modelAdmin->getDataAdmin(['is_delete_admin' => '0', 'akses_level !=' => '1'])->getResultArray();

            $data['pages'] = $pages;
            $data['data_user'] = $dataUser;

            echo view('Backend/Template/header', $data);
            echo view('Backend/Template/sidebar', $data);
            echo view('Backend/MasterAdmin/master-data-admin', $data);
            echo view('Backend/Template/footer', $data);
        }
    }
    public function edit_data_admin()
    {
        $uri = service('uri');
        $idEdit = $uri->getSegment(3);
        $modelAdmin = new M_admin;
        // Mengambil data admin dari table admin di database berdasarkan parameter yang dikirimkan
        // $dataAdmin = $modelAdmin->getDataAdmin(['sha1(id_admin)' => $idEdit])->getRowArray();
        $dataAdmin = $modelAdmin->db->table('tbl_admin')->where("sha1(id_admin)", $idEdit)->get()->getRowArray();
        session()->set(['idUpdate' => $dataAdmin['id_admin']]);

        $page = $uri->getSegment(2);

        $data['page'] = $page;
        $data['web_title'] = "Edit Data Admin";
        $data['data_admin'] = $dataAdmin; // mengirim array data admin ke view

        echo view('Backend/Template/header', $data);
        echo view('Backend/Template/sidebar', $data);
        echo view('Backend/MasterAdmin/edit-data-admin', $data);
        echo view('Backend/Template/footer', $data);
    }
    public function update_data_admin()
    {
        if(session()->get('ses_id')==="" or session()->get('ses_user')==="" or session()->get('ses_level')===""){
            session()->setFlashdata('error','Silakan login terlebih dahulu!');
            ?>
            <script>
                document.location = "<?= base_url('admin/login-admin');?>";
            </script>
            <?php
        }
        else{

            $modelAdmin = new M_admin;

            $idUpdate = session()->get('idUpdate');

            $nama = $this->request->getPost('nama');
            $level = $this->request->getPost('level');

            $dataUpdate = [
                'nama_admin' => $nama,
                'akses_level' => $level,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $where = [
                'id_admin' => $idUpdate
            ];

            $modelAdmin->updateDataAdmin($dataUpdate, $where);

            session()->setFlashdata('success','Data Admin Berhasil Diupdate!!');
            ?>
            <script>
                document.location = "<?= base_url('admin/master-data-admin');?>";
            </script>
            <?php
        }
    }
    public function hapus_data_admin($idHapus)
    {
        if(session()->get('ses_id')==="" or session()->get('ses_user')==="" or session()->get('ses_level')===""){
            session()->setFlashdata('error','Silakan login terlebih dahulu!');
            ?>
            <script>
                document.location = "<?= base_url('admin/login-admin');?>";
            </script>
            <?php
        }
        else{

            $modelAdmin = new M_admin;

            $where = [
                'sha1(id_admin)' => $idHapus
            ];

            $dataHapus = [
                'is_delete_admin' => '1',
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $modelAdmin->updateDataAdmin($dataHapus, $where);

            session()->setFlashdata('success','Data Admin Berhasil Dihapus!!');
            ?>
            <script>
                document.location = "<?= base_url('admin/master-data-admin');?>";
            </script>
            <?php
        }
    }
    
    // =========================
    // BUKU
    // =========================
    public function master_data_buku()
    {
        $modelBuku = new M_buku;

        $dataBuku = $modelBuku->getDataBukuJoin([
            'is_delete_buku' => '0'
        ])->getResultArray();

        $data['data_buku'] = $dataBuku;

        echo view('Backend/Template/header', $data);
        echo view('Backend/Template/sidebar', $data);
        echo view('Backend/MasterBuku/master-data-buku', $data);
        echo view('Backend/Template/footer', $data);
    }
    public function input_data_buku()
    {
        $modelKategori = new M_kategori;
        $modelRak = new M_rak;

        $data['kategori'] = $modelKategori
            ->getDataKategori([
                'is_delete_kategori' => '0'
            ])->getResultArray();

        $data['rak'] = $modelRak
            ->getDataRak([
                'is_delete_rak' => '0'
            ])->getResultArray();

        echo view('Backend/Template/header', $data);
        echo view('Backend/Template/sidebar', $data);
        echo view('Backend/MasterBuku/input-data-buku', $data);
        echo view('Backend/Template/footer', $data);
    }
    public function edit_data_buku($id)
    {
        $modelBuku = new M_buku;

        $dataBuku = $modelBuku->getDataBuku([
            'sha1(id_buku)' => $id
        ])->getRowArray();

        session()->set(['idUpdateBuku' => $dataBuku['id_buku']]);

        $data['data_buku'] = $dataBuku;

        echo view('Backend/Template/header', $data);
        echo view('Backend/Template/sidebar', $data);
        echo view('Backend/MasterBuku/edit-data-buku', $data);
        echo view('Backend/Template/footer', $data);
    }
    public function simpan_data_buku()
    {
        $modelBuku = new \App\Models\M_buku;
        $file = $this->request->getFile('cover');
        if (!$file->isValid()) {
            return redirect()->back();
        }
        $namaFile = $file->getRandomName();
        $file->move('uploads/buku/', $namaFile);
        $data = [
            'id_buku' => "BK".rand(100,999),
            'judul_buku' => $this->request->getPost('judul'),
            'pengarang' => $this->request->getPost('pengarang'),
            'penerbit' => $this->request->getPost('penerbit'),
            'tahun' => $this->request->getPost('tahun'),
            'jumlah_eksemplar' => $this->request->getPost('jumlah'),
            'id_kategori' => $this->request->getPost('kategori'),
            'id_rak' => $this->request->getPost('rak'),
            'keterangan' => $this->request->getPost('keterangan'),
            'cover_buku' => $namaFile,
            'is_delete_buku' => '0',
            'created_at' => date('Y-m-d H:i:s')
        ];
        $modelBuku->saveDataBuku($data);
        return redirect()->to(base_url('admin/master-data-buku'));
    }
    public function update_data_buku()
    {
        $modelBuku = new M_buku;
        $id = session()->get('idUpdateBuku');
        $file = $this->request->getFile('cover');
        if ($file && $file->isValid()) {
            $namaFile = $file->getRandomName();
            $file->move('uploads/buku/', $namaFile);
            $data = [
                'judul_buku' => $this->request->getPost('judul'),
                'pengarang' => $this->request->getPost('pengarang'),
                'penerbit' => $this->request->getPost('penerbit'),
                'tahun' => $this->request->getPost('tahun'),
                'jumlah_eksemplar' => $this->request->getPost('jumlah'),
                'id_kategori' => $this->request->getPost('kategori'),
                'id_rak' => $this->request->getPost('rak'),
                'keterangan' => $this->request->getPost('keterangan'),
                'cover_buku' => $namaFile,
                'updated_at' => date('Y-m-d H:i:s')
            ];
        } else {
            $data = [
                'judul_buku' => $this->request->getPost('judul'),
                'pengarang' => $this->request->getPost('pengarang'),
                'penerbit' => $this->request->getPost('penerbit'),
                'tahun' => $this->request->getPost('tahun'),
                'jumlah_eksemplar' => $this->request->getPost('jumlah'),
                'id_kategori' => $this->request->getPost('kategori'),
                'id_rak' => $this->request->getPost('rak'),
                'keterangan' => $this->request->getPost('keterangan'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }
        $where = ['id_buku' => $id];
        $modelBuku->updateDataBuku($data, $where);
        return redirect()->to(base_url('admin/master-data-buku'));
    }
    public function hapus_data_buku($id)
    {
        $modelBuku = new M_buku;
        $data = [
            'is_delete_buku' => '1',
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $where = [
            'sha1(id_buku)' => $id
        ];
        $modelBuku->updateDataBuku($data, $where);
        return redirect()->to(base_url('admin/master-data-buku'));
    }
}