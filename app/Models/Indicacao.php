<?php

namespace App\Models;

use App\Rules\CpfRule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicacao extends Model {
    use HasFactory;

    protected $table = 'indicacoes';
    protected $fillable = ['nome', 'cpf', 'email', 'telefone'];
    protected $appends = ['descricao_situacao'];

    public function rules() {
        return [
            'nome' => 'required',
            'cpf' => ['required', 'unique:indicacoes', new CpfRule()],
            'email' => 'required|email',
            'telefone' => 'required'
        ];
    }

    public function getDescricaoSituacaoAttribute($value) {
        if ($this->situacao == 'I') {
            return 'Iniciada';
        } else if ($this->situacao == 'EP') {
            return 'Em Processo';
        } else if ('F') {
            return 'Finalizada';
        }
    }

    public function alterarSituacao() {
        if ($this->situacao == 'I') {
            $this->situacao = 'EP';
        } else if ($this->situacao == 'EP') {
            $this->situacao = 'F';
        }
        $this->save();
    }

    public function save(array $options = []) {
        if (!$this->situacao) {
            $this->situacao = 'I';
        }
        parent::save($options);
    }

    // public function setNome($nome)
    // {
    //     $this->nome = $nome;
    // }

    // public function getNome()
    // {
    //     return $this->nome;
    // }

    // public function setCpf($cpf)
    // {
    //     $this->cpf = $cpf;
    // }

    // public function getCpf()
    // {
    //     return $this->cpf;
    // }

    // public function setEmail($email)
    // {
    //     $this->email = $email;
    // }

    // public function getEmail()
    // {
    //     return $this->email;
    // }

    // public function setTelefone($telefone)
    // {
    //     $this->telefone = $telefone;
    // }

    // public function getTelefone()
    // {
    //     return $this->telefone;
    // }
}
