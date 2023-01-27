<?php
class shop
{
    public $id;
    public $nama;
    public $jenis;
    public $tanggal_masuk;

    private $conn;
    private $table = "tbl_buku";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    function add()
        {
            $query = "INSERT INTO
                " . $this->table . "
            SET
               id=:id, nama=:nama, jenis=:jenis, tanggal_masuk=:tanggal_masuk";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam('id', $this->id);
            $stmt->bindParam('nama', $this->nama);
            $stmt->bindParam('jenis', $this->jenis);
            $stmt->bindParam('tanggal_masuk', $this->tanggal_masuk);

            if ($stmt->execute()) {
                return true;
            }
                return false;
            }
            function delete()
            {
                $query = "DELETE FROM " . $this->table . " WHERE id = ?";
                $stmt = $this->conn->prepare($$query);
                $stmt->bindParam(1, $this->id);

                if ($stmt->execute()) {
                    return true;
                }

                return false;
            }

            function fetch()
            {
                $query = "SELECT * FROM " . $this->table;
                $stmt = $this->conn->prepare($query);
                $stmt->execute();
                return $stmt;
            }

            function get()
            {
                $query = "SELECT * FROM " . $this->table . " p          
                WHERE
                    p.id = ?
                LIMIT
                0,1";

                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(1, $this->id);

                $stmt->execute();

                $perpus = $stmt->fetch(PDO::FETCH_ASSOC);

                $this->id = $perpus['id'];
                $this->nama = $perpus['nama'];
                $this->jenis = $perpus['jenis'];
                $this->tanggal_masuk = $perpus['tanggal_masuk'];
            }

            function update()
            {
                $query = "UPDATE
                " . $this->table . "
            SET
                nama= :nama,
                jenis= :jenis,
                tanggal_masuk = :tanggal_masuk
            WHERE
                id = :id";

                $stmt = $this->conn->prepare($query);

                $stmt->bindParam('id', $this->id);
                $stmt->bindParam('nama', $this->nama);
                $stmt->bindParam('jenis', $this->jenis);
                $stmt->bindParam('tanggal_masuk', $this->tanggal_masuk);

                if ($stmt->execute()) {
                    return true;
                }

                return false;
            }
        
    }