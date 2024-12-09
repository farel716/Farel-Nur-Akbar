<?php
include_once 'JsonDatabase.php';

class Barand {
    private $db;

    public function __construct() {
        $this->db = new JsonDatabase('barand.json');
    }

    public function create($nama, $harga, $stok) {
        $data = $this->db->read();
        $id = count($data) + 1; // Generate ID
        $data[] = ['id' => $id, 'nama' => $nama, 'harga' => $harga, 'stok' => $stok];
        $this->db->write($data);
    }

    public function read() {
        return $this->db->read();
    }

    public function update($id, $nama, $harga, $stok) {
        $data = $this->db->read();
        foreach ($data as &$item) {
            if ($item['id'] == $id) {
                $item['nama'] = $nama;
                $item['harga'] = $harga;
                $item['stok'] = $stok;
                break;
            }
        }
        $this->db->write($data);
    }

    public function delete($id) {
        $data = $this->db->read();
        $data = array_filter($data, function($item) use ($id) {
            return $item['id'] != $id;
        });
        $this->db->write(array_values($data));
    }

    public function find($id) {
        $data = $this->db->read();
        foreach ($data as $item) {
            if ($item['id'] == $id) {
                return $item;
            }
        }
        return null;
    }
}
?>