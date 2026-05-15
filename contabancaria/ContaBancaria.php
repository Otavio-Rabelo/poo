<?php

/*
========================================
========== CLASSE CONTA ==========
========================================
*/

class ContaBancaria
{
    public string $titular;
    public int $numeroConta;
    public float $saldo;
    public string $tipoConta;

    // Depositar dinheiro
    public function depositar(float $valor)
    {
        $this->saldo += $valor;
    }

    // Sacar dinheiro
    public function sacar(float $valor)
    {
        if($this->saldo >= $valor){

            $this->saldo -= $valor;

        }
        else{

            echo "Saldo insuficiente <br>";

        }
    }

    // Alterar tipo da conta
    public function alterarTipoConta(string $novoTipo)
    {
        $this->tipoConta = $novoTipo;
    }

    // Verificar saldo
    public function verificarSaldo()
    {
        if($this->saldo > 0){

            echo "Saldo positivo <br>";

        }
        else{

            echo "Saldo zerado <br>";

        }
    }

    // Exibir informações
    public function exibirInformacoes()
    {
        echo "Titular: $this->titular <br>";
        echo "Número da Conta: $this->numeroConta <br>";
        echo "Saldo: $this->saldo <br>";
        echo "Tipo da Conta: $this->tipoConta <br>";
    }

    // Comparar saldo
    public function compararSaldo(ContaBancaria $outraConta)
    {
        if($this->saldo > $outraConta->saldo){

            echo "$this->titular possui maior saldo <br>";

        }
        else if($this->saldo < $outraConta->saldo){

            echo "$this->titular possui menor saldo <br>";

        }
        else{

            echo "Os saldos são iguais <br>";

        }
    }
}



/*
========================================
============= CLASSE ALUNO ============
========================================
*/

class Aluno
{
    public string $nome;
    public int $idade;
    public float $nota;
    public string $turma;

    // Aumentar nota
    public function aumentarNota(float $valor)
    {
        $this->nota += $valor;

        // Impede nota acima de 100
        if($this->nota > 100){

            $this->nota = 100;

        }
    }

    // Diminuir nota
    public function diminuirNota(float $valor)
    {
        $this->nota -= $valor;
    }

    // Alterar turma
    public function alterarTurma(string $novaTurma)
    {
        $this->turma = $novaTurma;
    }

    // Verificar aprovação
    public function verificarAprovacao()
    {
        if($this->nota >= 60){

            echo "Aluno aprovado <br>";

        }
        else{

            echo "Aluno reprovado <br>";

        }
    }

    // Exibir informações
    public function exibirInformacoes()
    {
        echo "Nome: $this->nome <br>";
        echo "Idade: $this->idade <br>";
        echo "Nota: $this->nota <br>";
        echo "Turma: $this->turma <br>";
    }

    // Comparar notas
    public function compararNotas(Aluno $outroAluno)
    {
        if($this->nota > $outroAluno->nota){

            echo "$this->nome possui maior nota <br>";

        }
        else if($this->nota < $outroAluno->nota){

            echo "$this->nome possui menor nota <br>";

        }
        else{

            echo "As notas são iguais <br>";

        }
    }
}


