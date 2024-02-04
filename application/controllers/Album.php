    <?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Album extends CI_Controller
    {
        public function __construct()
        {

            parent::__construct();

            // Memeriksa apakah pengguna telah login
            if (!$this->session->userdata('email')) {
                redirect('login');
            }
            // Mendapatkan role_id dari sesi
            $role_id = $this->session->userdata('role_id');

            if ($role_id == 2) {
                // Jika role_id adalah 2, arahkan ke halaman tertentu atau berikan pesan kesalahan
                redirect('home');
            }
            // Load model 'M_album' untuk mengakses database
            $this->load->model('M_album');
        }

        public function index()
        {
            // Ambil data album dari database
            $data['albums'] = $this->M_album->getAlbums();

            // Load view
            $this->load->view('admin/sidebar');
            $this->load->view('album/content', $data);
        }

        public function add()
        {
            // Load view untuk menambahkan album
            $this->load->view('admin/sidebar');
            $this->load->view('album/add');
        }

        // public function add_album()
        // {
        //     // Form submission logic for creating album
        //     if ($this->input->post()) {
        //         $data = array(
        //             'nama_album' => $this->input->post('nama_album'),
        //             'deskripsi' => $this->input->post('deskripsi'),
        //             'tgl_buat' => date('Y-m-d H:i:s'), // Tanggal dibuat diisi dengan waktu sekarang
        //             'id_user' => $this->input->post('id_user'),
        //         );

        //         $this->M_album->insertAlbum($data);

        //         // Redirect or show success message
        //         redirect('album');
        //     } else {
        //         // Load view jika form tidak disubmit
        //         $this->load->view('admin/sidebar');
        //         $this->load->view('album/add'); 
        //     }
        // }

        public function add_album()
        {
            // Form submission logic for creating album
            if ($this->input->post()) {
                // Konfigurasi upload gambar
                $config['upload_path'] = './albums/'; // Sesuaikan dengan folder tempat menyimpan gambar
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 1024;  // Maksimal 1 MB

                // Load library upload
                $this->load->library('upload', $config);

                // Lakukan upload gambar
                if ($this->upload->do_upload('cover')) {
                    $upload_data = $this->upload->data();
                    $cover_path = $upload_data['file_name'];

                    // Data album
                    $data = array(
                        'nama_album' => $this->input->post('nama_album'),
                        'deskripsi' => $this->input->post('deskripsi'),
                        'tgl_buat' => date('Y-m-d H:i:s'), // Tanggal dibuat diisi dengan waktu sekarang
                        'id_user' => $this->input->post('id_user'),
                        'cover' => $cover_path // Menyimpan nama file gambar ke dalam kolom cover
                    );

                    // Memanggil model untuk menyimpan data album
                    $this->M_album->insertAlbum($data);

                    // Redirect or show success message
                    redirect('album');
                } else {
                    // Jika upload gagal, tampilkan pesan error
                    $error = array('error' => $this->upload->display_errors());
                    print_r($error);
                }
            } else {
                // Load view jika form tidak disubmit
                $this->load->view('admin/sidebar');
                $this->load->view('album/add');
            }
        }


        public function edit($id)
        {
            $data['album'] = $this->M_album->getAlbumById($id);
            $this->load->view('admin/sidebar');
            $this->load->view('album/edit', $data);
        }

        public function update($id)
        {
            // Form submission logic for updating album
            if ($this->input->post()) {
                // Konfigurasi upload gambar
                $config['upload_path'] = './albums/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 1024;

                // Load library upload
                $this->load->library('upload', $config);

                // Retrieve album data
                $album = $this->M_album->getAlbumById($id);

                // Lakukan upload gambar jika ada
                if ($this->upload->do_upload('cover')) {
                    // Hapus cover lama jika ada
                    $old_cover = $album->cover;
                    if (!empty($old_cover)) {
                        unlink('./albums/' . $old_cover);
                    }

                    // Simpan cover yang baru diupload
                    $upload_data = $this->upload->data();
                    $cover_path = $upload_data['file_name'];
                } else {
                    // Jika tidak ada upload baru, gunakan cover lama
                    $cover_path = $album->cover;
                }

                // Data album
                $data = array(
                    'nama_album' => $this->input->post('nama_album'),
                    'deskripsi' => $this->input->post('deskripsi'),
                    'tgl_buat' => date('Y-m-d H:i:s'), // Tanggal dibuat diisi dengan waktu sekarang
                    'id_user' => $this->input->post('id_user'),
                    'cover' => $cover_path // Menyimpan nama file gambar ke dalam kolom cover
                );

                // Memanggil model untuk mengupdate data album
                $this->M_album->updateAlbum($id, $data);

                // Redirect or show success message
                redirect('album');
            } else {
                // Load the edit view if no form submission
                $data['album'] = $this->M_album->getAlbumById($id);

                if (!$data['album']) {
                    // Handle if album is not found
                    show_404();
                }

                $this->load->view('admin/sidebar');
                $this->load->view('album/edit', $data);
            }
        }



        public function delete($id)
        {
            // Logic for deleting album
            $this->M_album->deleteAlbum($id);

            // Redirect or show success message
            redirect('album');
        }
    }
