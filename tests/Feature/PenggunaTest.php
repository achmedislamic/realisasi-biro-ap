<?php

namespace Tests\Feature;

use App\Http\Livewire\PenggunaForm;
use App\Http\Livewire\PenggunaTable;
use App\Models\User;
use Livewire\Livewire;
use Tests\FeatureTestCase;

class PenggunaTest extends FeatureTestCase
{
    public function test_pengguna_bisa_mengakses_menu()
    {
        $this->signIn();

        $response = $this->get('/pengguna');

        $response->assertStatus(200);
    }

    public function test_pengguna_bisa_mengakses_menu_form()
    {
        $this->signIn();

        $response = $this->get('/pengguna/form');

        $response->assertStatus(200);
    }

    public function test_pengguna_tidak_bisa_membuat_pengguna_jika_tidak_log_in()
    {
        $response = $this->get('/pengguna/form');

        $response->assertRedirect('/login');
    }

    public function test_pengguna_bisa_menambah_pengguna()
    {
        $this->signIn();

        Livewire::test(PenggunaForm::class)
            ->set('user.name', 'Pengguna Baru')
            ->set('user.email', 'penggunatest@example.com')
            ->set('password', 'penggunatest@example.com')
            ->set('password_confirmation', 'penggunatest@example.com')
            ->call('simpan')
            ->assertRedirect('/pengguna');
    }

    public function test_pengguna_bisa_mengubah_pengguna()
    {
        $user = User::factory()->create();
        $this->signIn($user);

        Livewire::test(PenggunaForm::class, ['id' => $user->id])
            ->set('user.name', 'Pengguna Baru')
            ->set('user.email', 'penggunatest@example.com')
            ->set('password', 'penggunatest@example.com')
            ->set('password_confirmation', 'penggunatest@example.com')
            ->call('simpan')
            ->assertRedirect('/pengguna');
    }

    public function test_pengguna_bisa_melihat_tabel_pengguna()
    {
        $user = User::factory()->create();
        $this->signIn($user);

        Livewire::test(PenggunaTable::class)
            ->assertSee($user->name);
    }

    public function test_pengguna_bisa_menghapus_pengguna()
    {
        $user = User::factory()->create();
        $this->signIn($user);

        Livewire::test(PenggunaTable::class)
            ->call('konfirmasiHapus', $user->id)
            ->assertSet('konfirmasi', $user->id)
            ->call('destroy', $user->id)
            ->assertDontSee($user->name);
    }
}
