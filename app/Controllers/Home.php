<?php

namespace App\Controllers;

use App\Models\HomeModel;
use CodeIgniter\Files\File;
use Config\Session;
use DateTime;

class Home extends BaseController
{
    protected $dash;

    public function __construct()
    {
        
session()->start();
        $this->dash = new HomeModel();
    }

    public function login()
    {
        return view('login');
    }

    public function ck_login(){
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $password = md5($password);

        if(!empty($username) && !empty($password)){
            $where = [
                'username' => $username,
                'password' => $password
            ];
            $result = $this->dash->datagetWhere('id_profil', $where);
            // var_dump($result);
            if($result->getRowArray() > 0){
                foreach($result->getResultArray() as $a){
                    $usernames = $a['username'];
                    $id_profil = $a['id_profil'];
                    $nama = $a['nama'];
                    $jabatan = $a['jabatan'];
                }
                session()->set('Username',$usernames);
                session()->set('ID',$id_profil);
                session()->set('Nama',$nama);
                session()->set('Jabatan',$jabatan);
                $result = redirect()->to('Home/index');
            } else {
                session()->setFlashdata('alert',[
                    'type' => 'danger',
                    'message' => 'Username atau password Salah'
                ]);
                $result = redirect()->to('login');
            }
            return $result;
        } else {
            
            session()->setFlashdata('alert',[
                'type' => 'danger',
                'message' => 'Username atau password Salah'
            ]);
            return redirect()->to('login');
        }
    }

    public function ck_logout()
    {
        session()->remove('Username');
        session()->remove('ID');
        session()->remove('Nama');
        session()->remove('Jabatan');
        return redirect()->to('login');
    }

    public function index()
    {   
        
        if(empty(session()->get('Nama'))){
            return redirect()->to('login');
          }
        $datavisitor = $this->dash->dataget('visitor', 'date','asc')->getResultArray();

        $tanggal = [];
        $jumlah = [];

        
        foreach ($datavisitor as $row) {
            $tanggal[] = $row['date']; // Menambahkan tanggal ke array $tanggal
            // $jumlah[] = $row['ip_address']; // Menambahkan jumlah ke array $jumlah
        }

        for($i = 0 ; $i<count($tanggal);$i++){
            $where = [
                'date' => $tanggal[$i]
            ];
            $jumlah[] = $this->dash->datagetWhere('visitor',$where,'date')->getNumRows();
            // $jumlah[] = count($b);
        }

        $data = [
            'visitor' => $datavisitor,
            'hari' =>$this->dash->dataget('hari','id_hari','asc')->getResultArray(),
            'tempat' => $this->dash->dataget('tempat_wisata')->getResultArray(),
            'fasili' => $this->dash->dataget('fasilitas')->getResultArray(),
            'harga' => $this->dash->dataget('harga_tiket','id_hari','asc')->getResultArray(),
            'fotos' => $this->dash->dataget('foto')->getResultArray(),
            'chartdata' => [
                'labels' => $tanggal,
                'datasets' => [
                    [
                        'label' => '# Pengunjung Website',
                        'data' => $jumlah,
                        'backgroundColor' => [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        'borderColor' => [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        'borderWidth' => 1,
                        'fill' => false
                    ]
                ]
            ]
        ];
        return view('pages_dash', $data);
    }

    public function input_tempat()
    {
        // $validationRules = [
        //     'file_tmpt' => 'uploaded[file_tmpt]|mime_in[file_tmpt,image/jpg,image/jpeg,image/png]',
        // ];

        // if($this->validate($validationRules)){
        //     $gambar = $this->request->getFile('file_tmpt');

        //     if (!empty($gambar) && $gambar->isValid() && !$gambar->hasMoved()) {

        //             if ($gambar->move('cms/images/foto_wisata/')) {
                        // $fotoName = $gambar->getName();
                        $id = "";

                        $tempat =  $this->request->getPost('nama_tempat');
                        $arrayData = [
                            'id_tempat' => $id,
                            'nama_tempat' => $tempat,
                            'nama_foto' => $fotoName
                        ];
                        
                        $this->dash->datainsert('tempat_wisata', $arrayData);
                    // }
                return redirect()->to('Home');
        //     } else {
        //         echo "Gagal";
        //     }
        // } else {
        //     echo "tidak valid";
        // }
    }

    public function input_profil()
    {
        $d = mt_rand(0000,9999);
        $id = "P".$d;
        $keterangan = $this->request->getPost('editor');

        if(!empty($keterangan)){
            $arrayData = [
                'id_profil' => $id,
                'keterangan' => $keterangan
            ];
            $this->dash->dataempty('profil_desa');
            $this->dash->datainsert('profil_desa', $arrayData);
            
            
            session()->setFlashdata('alert',[
                'type_alert' => 'success',
                'types' => 'berhasil',
                'message' => 'Berhasil Menginput Porfil Desa'
            ]);
            return redirect()->to('Home');
        } else {
            session()->setFlashdata('alert',[
                'type_alert' => 'success',
                'types' => 'gagal',
                'message' => 'Gagal Input Porfil Desa'
            ]);
            return redirect()->to('Home');
        }
    }

    public function input_foto()
    {
        $validationRules = [
            'gambar' => 'uploaded[gambar]|mime_in[gambar,imae/gjpg,image/jpeg,image/png]'
        ];
        
        if($this->validate($validationRules)){
            $gambar = $this->request->getFile('gambar');

            $gambars = getimagesize($gambar);
            $width = $gambars[0];
            $height = $gambars[1];
            
                if (!empty($gambar) && $gambar->isValid() && !$gambar->hasMoved()) {
                    $dataf = $this->dash->dataget('foto');
                    $row = $dataf->getNumRows();
                    $maxInput = 6;
                    if($row <= $maxInput){
                        if ($gambar->move('cms/images/foto_wisata/')) {
                            $fotoName = $gambar->getName();
                            $arrayData = [
                                'date' => date('Y-m-d H:i:s'),
                                'nama_file' => $fotoName
                            ];
                            $ids = '';
                            if($gambars !== false){
                                if($width === 1140 && $height === 640 ){
                                    $ids = 1;
                                } else if($width == 570 && $height == 320) {
                                    $ids = 2;
                                } else if($width == 740 && $height == 1340) {
                                    $ids = 3;
                                } else if ($width == 370 && $height == 320){
                                    $ids = 4;
                                } else if($width == 370 && $height == 325){
                                    $ids = 5;
                                } else if ($width == 1540 && $height==640 ){
                                    $ids = 6;
                                } 
                                
                                if(!empty($ids)){

                                    $where = [
                                        'id_foto' => $ids
                                    ];

                                    $b = $this->dash->datagetWhere('foto',$where)->getResultArray();
                                    foreach($b as $a){
                                        $nameFile = $a['nama_file'];
                                    }

                                    if(empty($namaFile)){
                                        $result = $this->dash->dataupdate('foto', $arrayData,$where);
                                            if($result){
                                                
                                                session()->setFlashdata('alert',[
                                                    'type_alert' => 'success',
                                                    'types' => 'berhasil',
                                                    'message' => 'Berhasil Input Foto'
                                                ]);
                                            }
                                        
                                        return redirect()->to('Home/index');
                                    } else {
                                        $filePath = FCPATH . 'cms/images/foto_wisata/'.$nameFile;
                                        if(file_exists($filePath)){
                                        
                                            if(unlink($filePath)){
                                            
                                                $result = $this->dash->dataupdate('foto', $arrayData,$where);
                                                if($result){
                                                    
                                                    session()->setFlashdata('alert',[
                                                        'type_alert' => 'success',
                                                        'types' => 'berhasil',
                                                        'message' => 'Berhasil Input Foto'
                                                    ]);
                                                }
                                            
                                            return redirect()->to('Home/index');
                                            
                                            } else {
                                                session()->setFlashdata('alert',[
                                                    'type_alert' => 'danger',
                                                    'types' => 'gagal',
                                                    'message' => 'Gagal Upload File'
                                                ]);
                                            }
                                        } else {
                                            session()->setFlashdata('alert',[
                                                'type_alert' => 'warning',
                                                'types' => 'berhasil',
                                                'message' => 'Gagal Upload File Dikarenakan File Sebelumnya Tidak ada'
                                            ]);
                                        }
                                    }
                                } else {
                                    
                                    session()->setFlashdata('alert',[
                                        'type_alert' => 'warning',
                                        'types' => 'gagal',
                                        'message' => 'Harap sesuaikan ukuran foto dengan table yang ada'
                                    ]);
                                }

                            } else {
                                session()->setFlashdata('alert',[
                                    'type_alert' => 'danger',
                                    'types' => 'gagal',
                                    'message' => 'Gagal Upload Foto'
                                ]);
                            }
                    } else {
                        session()->setFlashdata('alert',[
                            'type_alert' => 'danger',
                            'types' => 'gagal',
                            'message' => 'Gagal Upload Foto'
                        ]);
                    }
        
                return redirect()->to('Home');
                } else { 
                    
                session()->setFlashdata('alert',[
                    'type_alert' => 'warning',
                    'types' => 'gagal',
                    'message' => 'Maaf Foto Dibatasi Hanya 6 Foto silahkan hapus Salah satu foto terlebih dahulu'
                ]);
                return redirect()->to('home');
                }
            
            } else {
                session()->setFlashdata('alert',[
                    'type_alert' => 'warning',
                    'types' => 'gagal',
                    'message' => 'Pastikan file yang anda upload ada foto'
                ]);
                return redirect()->to('home');
            }
        } else {
            session()->setFlashdata('alert',[
                'type_alert' => 'warning',
                'types' => 'gagal',
                'message' => 'Harap Upload Foto dengan format .jpg, .jpeg, .png'
            ]);
            return redirect()->to('home');
        }
    }
    
    public function input_tick()
    {
        
        $tempat = $this->request->getPost('tempat_tiket');
        $hari=$this->request->getPost('hari_tiket');

        $where = [
            'id_hari' => $hari,
            'id_tempat' => $tempat
        ];
        $dataExist = $this->dash->datagetWhere('harga_tiket', $where);

        if($dataExist->getNumRows()==0) {
            $a = mt_rand(0000,9999);
        $id = "T".$a;
            $arrayData = [
                'id_tiket' => $id,
                'id_hari' => $hari,
                'harga' => $this->request->getPost('tiket'),
                'id_tempat' => $tempat
            ];
        
            $result = $this->dash->datainsert('harga_tiket', $arrayData);
            // var_dump($result);
            if($result) {
                session()->setFlashdata('alert',[
                    'type_alert' => 'success',
                    'types' => 'berhasil',
                    'message' => 'Berhasil Input Harga Tiket'
                ]);
            } else {
                session()->setFlashdata('alert',[
                    'type_alert' => 'danger',
                    'types' => 'gagal',
                    'message' => 'Gagal Input Harga Tiket'
                ]);
            }
        } else {
            $arrayData = [
                'id_hari' => $hari,
                'harga' => $this->request->getPost('tiket'),
                'id_tempat' => $tempat
            ];
            $result = $this->dash->dataupdate('harga_tiket',$arrayData,$where);
            if($result) {
                session()->setFlashdata('alert',[
                    'type_alert' => 'success',
                    'types' => 'berhasil',
                    'message' => 'Berhasil Input Harga Tiket'
                ]);
            } else {
                session()->setFlashdata('alert',[
                    'type_alert' => 'danger',
                    'types' => 'gagal',
                    'message' => 'Gagal Input Harga Tiket'
                ]);
            }
        }
        
        return redirect()->to('home');
    }

    public function input_fasilitas()
    {
        $a=mt_rand(0000,9999);
        $id = "FL".$a;
        $arrayData=[
            'id_fasilitas' => $id,
            'fasilitas' => $this->request->getPost('fasilitas'),
            'id_tempat' => $this->request->getPost('tempat_fasilitas')
        ];

        $result = $this->dash->datainsert('fasilitas',$arrayData);
        if($result){
            session()->setFlashdata('alert',[
                'type_alert' => 'success',
                'types' => 'berhasil',
                'message' => 'Berhasil Input Fasilitas Baru !'
            ]);
        }else {
            session()->setFlashdata('alert',[
                'type_alert' => 'danger',
                'types' => 'gagal',
                'message' => 'Gagal Input Fasilitas Baru !'
            ]);
        }
        return redirect()->to('home');
    }

    public function berirating ()
    {
        $data = [
            'tempat' => $this->dash->dataget('tempat_wisata')->getResultArray()
        ];
        return view('rating_us',$data);
    }

    public function input_rating()
    {
        $a = mt_rand(0000,9999);
        $id = "RVW".$a;
        $arrayData = [
            'id_review' => $id,
            'nama' => $this->request->getPost('nama'),
            'keterangan' => $this->request->getPost('keterangan'),
            'id_tempat' => $this->request->getPost('review_tempat'),
            'ratin' => $this->request->getPost('rating')

        ];

        $result = $this->dash->datainsert('reviewer',$arrayData);
        if($result){
            session()->setFlashdata('alert',[
                'type_alert' => 'success',
                'types' => 'berhasil',
                'message' => 'Terima Kasih Telah Memberikan Rating !'
            ]);
            return redirect()->to('berirating');
        } else {
            session()->setFlashdata('alert',[
                'type_alert' => 'danger',
                'types' => 'gagal',
                'message' => 'Gagal Memberikan Rating'
            ]);
        }
    }

    public function delete_foto()
    {
        $id_foto = $this->request->getPost('id_foto');
        if(!empty($id_foto)){
            $where = [
                'id_foto' => $id_foto
            ];
    
            $result = $this->dash->datagetWhere('foto',$where);
    
            foreach($result->getResultArray() as $a){
                $nama_file = $a['nama_file'];
            }       
    
            $filePath = FCPATH . 'cms/images/foto_wisata/'.$nama_file;
            if(file_exists($filePath)){
    
                if(unlink($filePath)){
    
                $this->dash->datadelete('foto',$where);
                
                return redirect()->to('Home/index');
    
                } else {
                    echo "gagal hapus";
                }
            } else {
                echo "file tidak ada";
            }
        } else {
            return redirect()->to('Home/index');
        }
        
    }

    public function delete_fasilitas()
    {
        $id_fasili = $this->request->getPost('id_fasilitas');

        if(!empty($id_fasili)){
            $where = [
                'id_fasilitas' => $id_fasili
            ];
    
            $this->dash->datadelete('fasilitas', $where);
            
            session()->setFlashdata('alert',[
                'type_alert' => 'success',
                'types' => 'berhasil',
                'message' => 'Berhasil Hapus Fasilitas'
            ]);
            return redirect()->to('home/index');
        } else {
            session()->setFlashdata('alert',[
                'type_alert' => 'danger',
                'types' => 'gagal',
                'message' => 'Gagal Hapus Fasilitas'
            ]);
            return redirect()->to('home/index');
        }
    }

}
