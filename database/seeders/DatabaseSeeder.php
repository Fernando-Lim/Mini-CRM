<?php

namespace Database\Seeders;

use bfinlay\SpreadsheetSeeder\SpreadsheetSeeder;
use Illuminate\Database\Seeder;
use Spatie\TranslationLoader\LanguageLine;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1)->create();
        $this->call([
            SpreadsheetSeeder::class,
        ]);

        //Companie
        LanguageLine::create([
            'group' => 'companie',
            'key' => 'title1',
            'text' => ['en' => 'Employee', 'id' => 'Karyawan'],
        ]);
        LanguageLine::create([
            'group' => 'companie',
            'key' => 'title2',
            'text' => ['en' => 'Add Employee', 'id' => 'Tambah Karyawan'],
        ]);
        LanguageLine::create([
            'group' => 'companie',
            'key' => 'title3',
            'text' => ['en' => 'Edit Employee', 'id' => 'Ubah Karyawan'],
        ]);


        //Companie Table
        LanguageLine::create([
            'group' => 'companie',
            'key' => 'table1',
            'text' => ['en' => 'Name', 'id' => 'Nama'],
        ]);
        LanguageLine::create([
            'group' => 'companie',
            'key' => 'table2',
            'text' => ['en' => 'Email', 'id' => 'Email'],
        ]);
        LanguageLine::create([
            'group' => 'companie',
            'key' => 'table3',
            'text' => ['en' => 'Logo', 'id' => 'Logo'],
        ]);
        LanguageLine::create([
            'group' => 'companie',
            'key' => 'table4',
            'text' => ['en' => 'Website', 'id' => 'Situs'],
        ]);
        LanguageLine::create([
            'group' => 'companie',
            'key' => 'table5',
            'text' => ['en' => 'Created At', 'id' => 'Dibuat'],
        ]);
        LanguageLine::create([
            'group' => 'companie',
            'key' => 'table6',
            'text' => ['en' => 'Updated At', 'id' => 'Diperbaharui'],
        ]);
        LanguageLine::create([
            'group' => 'companie',
            'key' => 'table7',
            'text' => ['en' => 'Action', 'id' => 'Aksi'],
        ]);


        //Companie Status
        LanguageLine::create([
            'group' => 'companie',
            'key' => 'status1',
            'text' => ['en' => 'No Data', 'id' => 'Data Kosong'],
        ]);
        LanguageLine::create([
            'group' => 'companie',
            'key' => 'status2',
            'text' => ['en' => 'Companie Added Sucessfully!', 'id' => 'Perusahaan Berhasil Ditambahkan!'],
        ]);
        LanguageLine::create([
            'group' => 'companie',
            'key' => 'status3',
            'text' => ['en' => 'Companie Updated Sucessfully!', 'id' => 'Perusahaan Berhasil Diubah!'],
        ]);
        LanguageLine::create([
            'group' => 'companie',
            'key' => 'status4',
            'text' => ['en' => 'Companie Deleted Successfully!', 'id' => 'Perusahaan Berhasil Dihapus!'],
        ]);


        //Companie Btn
        LanguageLine::create([
            'group' => 'companie',
            'key' => 'btn1',
            'text' => ['en' => 'Add Companie', 'id' => 'Tambah Perusahaan'],
        ]);
        LanguageLine::create([
            'group' => 'companie',
            'key' => 'btn2',
            'text' => ['en' => 'Edit', 'id' => 'Ubah'],
        ]);
        LanguageLine::create([
            'group' => 'companie',
            'key' => 'btn3',
            'text' => ['en' => 'Delete', 'id' => 'Hapus'],
        ]);
        LanguageLine::create([
            'group' => 'companie',
            'key' => 'btn4',
            'text' => ['en' => 'Back', 'id' => 'Kembali'],
        ]);
        LanguageLine::create([
            'group' => 'companie',
            'key' => 'btn5',
            'text' => ['en' => 'Edit Companie', 'id' => 'Ubah Perusahaan'],
        ]);
        LanguageLine::create([
            'group' => 'companie',
            'key' => 'btn6',
            'text' => ['en' => 'Filter', 'id' => 'Filter'],
        ]);
        LanguageLine::create([
            'group' => 'companie',
            'key' => 'btn7',
            'text' => ['en' => 'Refresh', 'id' => 'Muat Ulang'],
        ]);


        //Companie Date
        LanguageLine::create([
            'group' => 'companie',
            'key' => 'fromdate',
            'text' => ['en' => 'From Date', 'id' => 'Dari Tanggal'],
        ]);
        LanguageLine::create([
            'group' => 'companie',
            'key' => 'todate',
            'text' => ['en' => 'To Date', 'id' => 'Sampai Tanggal'],
        ]);


        //Companie Filter
        LanguageLine::create([
            'group' => 'companie',
            'key' => 'filterfirstname',
            'text' => ['en' => 'First Name', 'id' => 'Nama Depan'],
        ]);
        LanguageLine::create([
            'group' => 'companie',
            'key' => 'filteremail',
            'text' => ['en' => 'Email', 'id' => 'Email'],
        ]);
        LanguageLine::create([
            'group' => 'companie',
            'key' => 'filterwebsite',
            'text' => ['en' => 'Website', 'id' => 'Situs'],
        ]);


        //Companie Alert
        LanguageLine::create([
            'group' => 'companie',
            'key' => 'alert',
            'text' => ['en' => 'Are You Sure?', 'id' => 'Anda Yakin?'],
        ]);




        //Employee Title
        LanguageLine::create([
            'group' => 'employee',
            'key' => 'title1',
            'text' => ['en' => 'Employee', 'id' => 'Karyawan'],
        ]);
        LanguageLine::create([
            'group' => 'employee',
            'key' => 'title2',
            'text' => ['en' => 'Add Employee', 'id' => 'Tambah Karyawan'],
        ]);
        LanguageLine::create([
            'group' => 'employee',
            'key' => 'title3',
            'text' => ['en' => 'Edit Employee', 'id' => 'Ubah Karyawan'],
        ]);


        //Employee Table
        LanguageLine::create([
            'group' => 'employee',
            'key' => 'table1',
            'text' => ['en' => 'First Name', 'id' => 'Nama Depan'],
        ]);
        LanguageLine::create([
            'group' => 'employee',
            'key' => 'table2',
            'text' => ['en' => 'Last Name', 'id' => 'Nama Belakang'],
        ]);
        LanguageLine::create([
            'group' => 'employee',
            'key' => 'table3',
            'text' => ['en' => 'Company Name', 'id' => 'Nama Perusahaan'],
        ]);
        LanguageLine::create([
            'group' => 'employee',
            'key' => 'table4',
            'text' => ['en' => 'Email', 'id' => 'Email'],
        ]);
        LanguageLine::create([
            'group' => 'employee',
            'key' => 'table5',
            'text' => ['en' => 'Phone', 'id' => 'Ponsel'],
        ]);
        LanguageLine::create([
            'group' => 'employee',
            'key' => 'table6',
            'text' => ['en' => 'Created At', 'id' => 'Dibuat'],
        ]);
        LanguageLine::create([
            'group' => 'employee',
            'key' => 'table7',
            'text' => ['en' => 'Updated At', 'id' => 'Diperbaharui'],
        ]);
        LanguageLine::create([
            'group' => 'employee',
            'key' => 'table8',
            'text' => ['en' => 'Action', 'id' => 'Aksi'],
        ]);


        //Employee Status
        LanguageLine::create([
            'group' => 'employee',
            'key' => 'status1',
            'text' => ['en' => 'No Data', 'id' => 'Data Kosong'],
        ]);
        LanguageLine::create([
            'group' => 'employee',
            'key' => 'status2',
            'text' => ['en' => 'Employee Added Sucessfully!', 'id' => 'Karyawan Berhasil Ditambahkan!'],
        ]);
        LanguageLine::create([
            'group' => 'employee',
            'key' => 'status3',
            'text' => ['en' => 'Employee Updated Sucessfully!', 'id' => 'Karyawan Berhasil Diubah!'],
        ]);
        LanguageLine::create([
            'group' => 'employee',
            'key' => 'status4',
            'text' => ['en' => 'Employee Deleted Successfully!', 'id' => 'Karyawan Berhasil Dihapus!'],
        ]);


        //Employee Btn
        LanguageLine::create([
            'group' => 'employee',
            'key' => 'btn1',
            'text' => ['en' => 'Add Employee', 'id' => 'Tambah Karyawan'],
        ]);
        LanguageLine::create([
            'group' => 'employee',
            'key' => 'btn2',
            'text' => ['en' => 'Edit', 'id' => 'Ubah'],
        ]);
        LanguageLine::create([
            'group' => 'employee',
            'key' => 'btn3',
            'text' => ['en' => 'Delete', 'id' => 'Hapus'],
        ]);
        LanguageLine::create([
            'group' => 'employee',
            'key' => 'btn4',
            'text' => ['en' => 'Back', 'id' => 'Kembali'],
        ]);
        LanguageLine::create([
            'group' => 'employee',
            'key' => 'btn5',
            'text' => ['en' => 'Edit Employee', 'id' => 'Ubah Karyawan'],
        ]);
        LanguageLine::create([
            'group' => 'employee',
            'key' => 'btn6',
            'text' => ['en' => 'Filter', 'id' => 'Filter'],
        ]);
        LanguageLine::create([
            'group' => 'employee',
            'key' => 'btn7',
            'text' => ['en' => 'Refresh', 'id' => 'Muat Ulang'],
        ]);


        //Employee Date
        LanguageLine::create([
            'group' => 'employee',
            'key' => 'fromdate',
            'text' => ['en' => 'From Date', 'id' => 'Dari Tanggal'],
        ]);
        LanguageLine::create([
            'group' => 'employee',
            'key' => 'todate',
            'text' => ['en' => 'To Date', 'id' => 'Sampai Tanggal'],
        ]);


        //Employee Filter
        LanguageLine::create([
            'group' => 'employee',
            'key' => 'filterfirstname',
            'text' => ['en' => 'First Name', 'id' => 'Nama Depan'],
        ]);
        LanguageLine::create([
            'group' => 'employee',
            'key' => 'filterlastname',
            'text' => ['en' => 'Last Name', 'id' => 'Nama Belakang'],
        ]);
        LanguageLine::create([
            'group' => 'employee',
            'key' => 'filtercompany',
            'text' => ['en' => 'Company Name', 'id' => 'Nama Perusahaan'],
        ]);
        LanguageLine::create([
            'group' => 'employee',
            'key' => 'filteremail',
            'text' => ['en' => 'Email', 'id' => 'Email'],
        ]);
        LanguageLine::create([
            'group' => 'employee',
            'key' => 'filterphonenumber',
            'text' => ['en' => 'Phone Number', 'id' => 'Ponsel'],
        ]);


        //Employee Alert
        LanguageLine::create([
            'group' => 'employee',
            'key' => 'alert',
            'text' => ['en' => 'Are You Sure?', 'id' => 'Anda Yakin?'],
        ]);


        //Item Title
        LanguageLine::create([
            'group' => 'item',
            'key' => 'title1',
            'text' => ['en' => 'Item', 'id' => 'Barang'],
        ]);
        LanguageLine::create([
            'group' => 'item',
            'key' => 'title2',
            'text' => ['en' => 'Add Item', 'id' => 'Tambah Barang'],
        ]);
        LanguageLine::create([
            'group' => 'item',
            'key' => 'title3',
            'text' => ['en' => 'Edit Item', 'id' => 'Ubah Barang'],
        ]);


        //Item Table
        LanguageLine::create([
            'group' => 'item',
            'key' => 'table1',
            'text' => ['en' => 'Name', 'id' => 'Nama'],
        ]);
        LanguageLine::create([
            'group' => 'item',
            'key' => 'table2',
            'text' => ['en' => 'Price', 'id' => 'Harga'],
        ]);
        LanguageLine::create([
            'group' => 'item',
            'key' => 'table3',
            'text' => ['en' => 'Created At', 'id' => 'Dibuat'],
        ]);
        LanguageLine::create([
            'group' => 'item',
            'key' => 'table4',
            'text' => ['en' => 'Updated At', 'id' => 'Diperbaharui'],
        ]);
        LanguageLine::create([
            'group' => 'item',
            'key' => 'table5',
            'text' => ['en' => 'Action', 'id' => 'Aksi'],
        ]);


        //Item Status
        LanguageLine::create([
            'group' => 'item',
            'key' => 'status1',
            'text' => ['en' => 'No Data', 'id' => 'Data Kosong'],
        ]);
        LanguageLine::create([
            'group' => 'item',
            'key' => 'status2',
            'text' => ['en' => 'Item Added Sucessfully!', 'id' => 'Barang Berhasil Ditambahkan!'],
        ]);
        LanguageLine::create([
            'group' => 'item',
            'key' => 'status3',
            'text' => ['en' => 'Item Updated Sucessfully!', 'id' => 'Barang Berhasil Diubah!'],
        ]);
        LanguageLine::create([
            'group' => 'item',
            'key' => 'status4',
            'text' => ['en' => 'Item Deleted Successfully!', 'id' => 'Barang Berhasil Dihapus!'],
        ]);


        //Item Btn
        LanguageLine::create([
            'group' => 'item',
            'key' => 'btn1',
            'text' => ['en' => 'Add Item', 'id' => 'Tambah Barang'],
        ]);
        LanguageLine::create([
            'group' => 'item',
            'key' => 'btn2',
            'text' => ['en' => 'Edit', 'id' => 'Ubah'],
        ]);
        LanguageLine::create([
            'group' => 'item',
            'key' => 'btn3',
            'text' => ['en' => 'Delete', 'id' => 'Hapus'],
        ]);
        LanguageLine::create([
            'group' => 'item',
            'key' => 'btn4',
            'text' => ['en' => 'Back', 'id' => 'Kembali'],
        ]);
        LanguageLine::create([
            'group' => 'item',
            'key' => 'btn5',
            'text' => ['en' => 'Edit Item', 'id' => 'Ubah Barang'],
        ]);
        LanguageLine::create([
            'group' => 'item',
            'key' => 'btn6',
            'text' => ['en' => 'Filter', 'id' => 'Filter'],
        ]);
        LanguageLine::create([
            'group' => 'item',
            'key' => 'btn7',
            'text' => ['en' => 'Refresh', 'id' => 'Muat Ulang'],
        ]);


        //Item Date
        LanguageLine::create([
            'group' => 'item',
            'key' => 'fromdate',
            'text' => ['en' => 'From Date', 'id' => 'Dari Tanggal'],
        ]);
        LanguageLine::create([
            'group' => 'item',
            'key' => 'todate',
            'text' => ['en' => 'To Date', 'id' => 'Sampai Tanggal'],
        ]);


        //Item Filter
        LanguageLine::create([
            'group' => 'item',
            'key' => 'filtername',
            'text' => ['en' => 'Name', 'id' => 'Nama'],
        ]);
        LanguageLine::create([
            'group' => 'item',
            'key' => 'filterprice',
            'text' => ['en' => 'Price', 'id' => 'Harga'],
        ]);


        //Item Alert
        LanguageLine::create([
            'group' => 'item',
            'key' => 'alert',
            'text' => ['en' => 'Are You Sure?', 'id' => 'Anda Yakin?'],
        ]);


        //Sell Title
        LanguageLine::create([
            'group' => 'sell',
            'key' => 'title1',
            'text' => ['en' => 'Sales', 'id' => 'Transaksi'],
        ]);
        LanguageLine::create([
            'group' => 'sell',
            'key' => 'title2',
            'text' => ['en' => 'Add Sales', 'id' => 'Mulai Transaksi'],
        ]);
        LanguageLine::create([
            'group' => 'sell',
            'key' => 'title3',
            'text' => ['en' => 'Edit Sales', 'id' => 'Ubah Transaksi'],
        ]);


        //Sell Table
        LanguageLine::create([
            'group' => 'sell',
            'key' => 'table1',
            'text' => ['en' => 'Date', 'id' => 'Tanggal'],
        ]);
        LanguageLine::create([
            'group' => 'sell',
            'key' => 'table2',
            'text' => ['en' => 'Item', 'id' => 'Barang'],
        ]);
        LanguageLine::create([
            'group' => 'sell',
            'key' => 'table3',
            'text' => ['en' => 'Price', 'id' => 'Harga'],
        ]);
        LanguageLine::create([
            'group' => 'sell',
            'key' => 'table4',
            'text' => ['en' => 'Discount %', 'id' => 'Promo %'],
        ]);
        LanguageLine::create([
            'group' => 'sell',
            'key' => 'table5',
            'text' => ['en' => 'Employee', 'id' => 'Karyawan'],
        ]);
        LanguageLine::create([
            'group' => 'sell',
            'key' => 'table6',
            'text' => ['en' => 'Action', 'id' => 'Aksi'],
        ]);


        //Sell Status
        LanguageLine::create([
            'group' => 'sell',
            'key' => 'status1',
            'text' => ['en' => 'No Data', 'id' => 'Data Kosong'],
        ]);
        LanguageLine::create([
            'group' => 'sell',
            'key' => 'status2',
            'text' => ['en' => 'Sales Added Successfully!', 'id' => 'Transaksi Berhasil Ditambahkan!'],
        ]);
        LanguageLine::create([
            'group' => 'sell',
            'key' => 'status3',
            'text' => ['en' => 'Sales Updated Successfully!', 'id' => 'Transaksi Berhasil Diubah!'],
        ]);
        LanguageLine::create([
            'group' => 'sell',
            'key' => 'status4',
            'text' => ['en' => 'Sales Deleted Successfully!', 'id' => 'Transaksi Berhasil Dihapus!'],
        ]);


        //Sell Btn
        LanguageLine::create([
            'group' => 'sell',
            'key' => 'btn1',
            'text' => ['en' => 'Add Sales', 'id' => 'Mulai Transaksi'],
        ]);
        LanguageLine::create([
            'group' => 'sell',
            'key' => 'btn2',
            'text' => ['en' => 'Edit', 'id' => 'Ubah'],
        ]);
        LanguageLine::create([
            'group' => 'sell',
            'key' => 'btn3',
            'text' => ['en' => 'Delete', 'id' => 'Hapus'],
        ]);
        LanguageLine::create([
            'group' => 'sell',
            'key' => 'btn4',
            'text' => ['en' => 'Back', 'id' => 'Kembali'],
        ]);
        LanguageLine::create([
            'group' => 'sell',
            'key' => 'btn5',
            'text' => ['en' => 'Edit Sales', 'id' => 'Ubah Transaksi'],
        ]);
        LanguageLine::create([
            'group' => 'sell',
            'key' => 'btn6',
            'text' => ['en' => 'Filter', 'id' => 'Filter'],
        ]);
        LanguageLine::create([
            'group' => 'sell',
            'key' => 'btn7',
            'text' => ['en' => 'Refresh', 'id' => 'Muat Ulang'],
        ]);


        //Sell Date
        LanguageLine::create([
            'group' => 'sell',
            'key' => 'fromdate',
            'text' => ['en' => 'From Date', 'id' => 'Dari Tanggal'],
        ]);
        LanguageLine::create([
            'group' => 'sell',
            'key' => 'todate',
            'text' => ['en' => 'To Date', 'id' => 'Sampai Tanggal'],
        ]);


        //Sell Filter
        LanguageLine::create([
            'group' => 'sell',
            'key' => 'filteritem',
            'text' => ['en' => 'Item', 'id' => 'Barang'],
        ]);
        LanguageLine::create([
            'group' => 'sell',
            'key' => 'filteremployee',
            'text' => ['en' => 'Employee', 'id' => 'Karyawan'],
        ]);

        //Sell Dropdown option
        LanguageLine::create([
            'group' => 'sell',
            'key' => 'optionitem',
            'text' => ['en' => 'Select Item', 'id' => 'Pilih Barang'],
        ]);
        LanguageLine::create([
            'group' => 'sell',
            'key' => 'optionemployee',
            'text' => ['en' => 'Select Employee', 'id' => 'Pilih Karyawan'],
        ]);


        //Sell Alert
        LanguageLine::create([
            'group' => 'sell',
            'key' => 'alert',
            'text' => ['en' => 'Are You Sure?', 'id' => 'Anda Yakin?'],
        ]);

        //sellSummary Title
        LanguageLine::create([
            'group' => 'sellSummary',
            'key' => 'title1',
            'text' => ['en' => 'Sales Summary', 'id' => 'Laporan Transaksi'],
        ]);
        LanguageLine::create([
            'group' => 'sellSummary',
            'key' => 'title2',
            'text' => ['en' => 'Sales Preview', 'id' => 'Ringkasan Transaksi'],
        ]);


        //sellSummary Table
        LanguageLine::create([
            'group' => 'sellSummary',
            'key' => 'table1',
            'text' => ['en' => 'Date', 'id' => 'Tanggal'],
        ]);
        LanguageLine::create([
            'group' => 'sellSummary',
            'key' => 'table2',
            'text' => ['en' => 'Company', 'id' => 'Perusahaan'],
        ]);
        LanguageLine::create([
            'group' => 'sellSummary',
            'key' => 'table3',
            'text' => ['en' => 'Employee', 'id' => 'Karyawan'],
        ]);
        LanguageLine::create([
            'group' => 'sellSummary',
            'key' => 'table4',
            'text' => ['en' => 'Created At', 'id' => 'Dibuat'],
        ]);
        LanguageLine::create([
            'group' => 'sellSummary',
            'key' => 'table5',
            'text' => ['en' => 'Updated At', 'id' => 'Diperbaharui'],
        ]);
        LanguageLine::create([
            'group' => 'sellSummary',
            'key' => 'table6',
            'text' => ['en' => 'Price Total', 'id' => 'Total Harga'],
        ]);
        LanguageLine::create([
            'group' => 'sellSummary',
            'key' => 'table7',
            'text' => ['en' => 'Discount Total', 'id' => 'Total Promo'],
        ]);
        LanguageLine::create([
            'group' => 'sellSummary',
            'key' => 'table8',
            'text' => ['en' => 'Total', 'id' => 'Total'],
        ]);


        //sellSummary Status
        LanguageLine::create([
            'group' => 'sellSummary',
            'key' => 'status1',
            'text' => ['en' => 'No Data', 'id' => 'Data Kosong'],
        ]);

        //sellSummary Btn
        LanguageLine::create([
            'group' => 'sellSummary',
            'key' => 'btn1',
            'text' => ['en' => 'Back', 'id' => 'Kembali'],
        ]);
        LanguageLine::create([
            'group' => 'sellSummary',
            'key' => 'btn2',
            'text' => ['en' => 'Filter', 'id' => 'Filter'],
        ]);
        LanguageLine::create([
            'group' => 'sellSummary',
            'key' => 'btn3',
            'text' => ['en' => 'Refresh', 'id' => 'Muat Ulang'],
        ]);


        //sellSummary Date
        LanguageLine::create([
            'group' => 'sellSummary',
            'key' => 'fromdate',
            'text' => ['en' => 'From Date', 'id' => 'Dari Tanggal'],
        ]);
        LanguageLine::create([
            'group' => 'sellSummary',
            'key' => 'todate',
            'text' => ['en' => 'To Date', 'id' => 'Sampai Tanggal'],
        ]);


        //sellSummary Filter
        LanguageLine::create([
            'group' => 'sellSummary',
            'key' => 'filtername',
            'text' => ['en' => 'Select Employee', 'id' => 'Pilih Karyawan'],
        ]);
        LanguageLine::create([
            'group' => 'sellSummary',
            'key' => 'filtercompany',
            'text' => ['en' => 'Select Companie', 'id' => 'Pilih Perusahaan'],
        ]);

        //sellSummary Alert
        LanguageLine::create([
            'group' => 'sellSummary',
            'key' => 'detail',
            'text' => ['en' => 'Transactions', 'id' => 'Transaksi'],
        ]);


        //sellSummary Alert
        LanguageLine::create([
            'group' => 'sellSummary',
            'key' => 'alert',
            'text' => ['en' => 'Are You Sure?', 'id' => 'Anda Yakin?'],
        ]);

        //Home
        LanguageLine::create([
            'group' => 'home',
            'key' => 'header',
            'text' => ['en' => 'Dashboard', 'id' => 'Menu Utama'],
        ]);
        LanguageLine::create([
            'group' => 'home',
            'key' => 'body',
            'text' => ['en' => 'You Are Logged In!', 'id' => 'Kamu Sudah Masuk!'],
        ]);
        LanguageLine::create([
            'group' => 'home',
            'key' => 'component-employee',
            'text' => ['en' => 'Employees', 'id' => 'Karyawan'],
        ]);
        LanguageLine::create([
            'group' => 'home',
            'key' => 'component-companie',
            'text' => ['en' => 'Companies', 'id' => 'Perusahaan'],
        ]);


        // \App\Models\Employee::factory(1000)->create();
        // \App\Models\Companie::factory(1000)->create();
    }
}
