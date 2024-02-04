<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_foto extends CI_Model
{
    public function getFotos()
    {
        // Ambil data foto dari database
        return $this->db->get('tbl_foto')->result();
    }

    public function insertFoto($data)
    {
        // Insert data foto ke database
        $this->db->insert('tbl_foto', $data);
    }

    public function getFotoById($id)
    {
        // Ambil data foto berdasarkan ID
        return $this->db->get_where('tbl_foto', array('id_foto' => $id))->row();
    }

    public function updateFoto($id, $data)
    {
        // Update data foto berdasarkan ID
        $this->db->where('id_foto', $id);
        $this->db->update('tbl_foto', $data);
    }

    public function deleteFoto($id)
    {
        // Hapus data foto berdasarkan ID
        $this->db->delete('tbl_foto', array('id_foto' => $id));
    }
    public function getFotaso_id_album($id_album)
    {
        $this->db->select('*');
        $this->db->from('tbl_foto');
        $this->db->where('id_album', $id_album);
        $query = $this->db->get();
        return $query->result();
    }
    // Contoh pada M_foto model
    // Contoh pada M_foto model
    public function getFoto_id_album($id_album)
    {
        $this->db->select('tbl_foto.*, tbl_user.username, tbl_user.profil');
        $this->db->from('tbl_foto');
        $this->db->join('tbl_user', 'tbl_foto.id_user = tbl_user.id_user');
        $this->db->where('tbl_foto.id_album', $id_album);
        $query = $this->db->get();

        return $query->result_array();
    }
    public function getUser_andid_foto($id_foto)
    {
        $this->db->select('tbl_user.username, tbl_user.profil');
        $this->db->from('tbl_user');
        $this->db->join('tbl_foto', 'tbl_user.id_user = tbl_foto.id_user');
        $this->db->where('tbl_foto.id_foto', $id_foto);

        $query = $this->db->get();

        return $query->row_array();
    }

    public function getIdFoto($id_foto)
    {
        $this->db->where('id_foto', $id_foto);
        $query = $this->db->get('tbl_foto');
        return $query->row(); // Assuming you want to retrieve a single photo
    }
    // mengambil data album
    public function getAlbumsWithFoto()
    {
        $this->db->select('tbl_foto.*, tbl_album.nama_album');
        $this->db->from('tbl_foto');
        $this->db->join('tbl_album', 'tbl_foto.id_album = tbl_album.id_album');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getAlbumsdanId_user($id_user)
    {
        // Fetch album data from the database based on id_user
        $this->db->where('id_user', $id_user);
        $query = $this->db->get('tbl_album'); // Ganti 'your_album_table_name' dengan nama tabel yang sesuai

        // Check if there are records
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array(); // Return an empty array if no records found
        }
    }
    // menampilkan data foto sesuai id_user
    public function getFotoByIdUser($id_user)
    {
        // Sesuaikan dengan nama tabel dan kolom pada database Anda
        $this->db->where('id_user', $id_user);
        $query = $this->db->get('tbl_foto');

        // Kembalikan hasil query
        return $query->result();
    }
    public function searchFoto($keywords)
    {
        $this->db->select('tbl_foto.*, tbl_user.username, tbl_user.profil');
        $this->db->from('tbl_foto');
        $this->db->join('tbl_user', 'tbl_foto.id_user = tbl_user.id_user');

        // Menghapus spasi dari setiap kata kunci
        $keywords = array_map('trim', $keywords);
        $keywords = array_filter($keywords);

        if (!empty($keywords)) {
            // Cek apakah ada kata yang sama dengan judul_foto
            $this->db->group_start();
            foreach ($keywords as $keyword) {
                $this->db->or_where('REPLACE(judul_foto, " ", "") =', str_replace(" ", "", $keyword));
            }
            $this->db->group_end();

            // Jika tidak ada kata yang sama, cari huruf per huruf
            $this->db->or_group_start();
            foreach ($keywords as $keyword) {
                $length = strlen($keyword);
                $this->db->group_start();
                for ($i = 0; $i < $length; $i++) {
                    $this->db->or_like('REPLACE(judul_foto, " ", "")', substr($keyword, $i, 1));
                }
                $this->db->group_end();
            }
            $this->db->group_end();
        }

        $query = $this->db->get();

        // Periksa apakah query mengembalikan hasil atau null
        if ($query !== null) {
            $result = $query->result_array();

            // Jika hasil pencarian hanya satu, langsung tampilkan
            if (count($result) === 1) {
                return $result;
            }

            // Jika ada kata yang sama dengan judul_foto, ambil yang sesuai dengan pencarian
            $filteredResult = array();
            foreach ($result as $row) {
                foreach ($keywords as $keyword) {
                    if (stripos($row['judul_foto'], $keyword) !== false) {
                        $filteredResult[] = $row;
                        break;
                    }
                }
            }

            return $filteredResult;
        } else {
            return array();
        }
    }

    // public function searchFoto($keywords)
    // {
    //     $this->db->select('tbl_foto.*, tbl_user.username, tbl_user.profil');
    //     $this->db->from('tbl_foto');
    //     $this->db->join('tbl_user', 'tbl_foto.id_user = tbl_user.id_user');

    //     // Menghapus spasi dari setiap kata kunci
    //     $keywords = array_map('trim', $keywords);
    //     $keywords = array_filter($keywords);

    //     if (!empty($keywords)) {
    //         $this->db->group_start();
    //         foreach ($keywords as $keyword) {
    //             $this->db->group_start();
    //             $length = strlen($keyword);
    //             for ($i = 0; $i < $length; $i++) {
    //                 $this->db->or_like('REPLACE(judul_foto, " ", "")', substr($keyword, $i, 1));
    //             }
    //             $this->db->group_end();
    //         }
    //         $this->db->group_end();
    //     }

    //     $query = $this->db->get();

    //     // Periksa apakah query mengembalikan hasil atau null
    //     if ($query !== null) {
    //         return $query->result_array();
    //     } else {
    //         return array();
    //     }
    // }
}
