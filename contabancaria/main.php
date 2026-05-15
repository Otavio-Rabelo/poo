<?php
/*
========================================
=========== MAIN CONTA =================
========================================
*/

// OBJETO 1
$conta1 = new ContaBancaria();

$conta1->titular = "João";
$conta1->numeroConta = 101;
$conta1->saldo = 500;
$conta1->tipoConta = "Corrente";


// OBJETO 2
$conta2 = new ContaBancaria();

$conta2->titular = "Maria";
$conta2->numeroConta = 202;
$conta2->saldo = 1000;
$conta2->tipoConta = "Poupança";


// OBJETO 3
$conta3 = new ContaBancaria();

$conta3->titular = "Carlos";
$conta3->numeroConta = 303;
$conta3->saldo = 0;
$conta3->tipoConta = "Corrente";


// EXIBIR
echo "INFORMAÇÕES INICIAIS DAS CONTAS <br><br>";

$conta1->exibirInformacoes();
echo "<br>";

$conta2->exibirInformacoes();
echo "<br>";

$conta3->exibirInformacoes();
echo "<br><br>";


// AÇÕES
$conta1->depositar(300);

$conta2->sacar(200);

$conta3->alterarTipoConta("Poupança");

echo "<br>";


// VERIFICAÇÕES
$conta1->verificarSaldo();

$conta2->verificarSaldo();

$conta3->verificarSaldo();

echo "<br>";


// COMPARAÇÕES
$conta1->compararSaldo($conta2);

$conta2->compararSaldo($conta3);

echo "<br><br>";



/*
========================================
============ MAIN ALUNO ===============
========================================
*/

// OBJETO 1
$aluno1 = new Aluno();

$aluno1->nome = "Lucas";
$aluno1->idade = 16;
$aluno1->nota = 70;
$aluno1->turma = "2A";


// OBJETO 2
$aluno2 = new Aluno();

$aluno2->nome = "Ana";
$aluno2->idade = 17;
$aluno2->nota = 95;
$aluno2->turma = "3B";


// OBJETO 3
$aluno3 = new Aluno();

$aluno3->nome = "Pedro";
$aluno3->idade = 16;
$aluno3->nota = 40;
$aluno3->turma = "2C";


// EXIBIR
echo "INFORMAÇÕES INICIAIS DOS ALUNOS <br><br>";

$aluno1->exibirInformacoes();
echo "<br>";

$aluno2->exibirInformacoes();
echo "<br>";

$aluno3->exibirInformacoes();
echo "<br><br>";


// AÇÕES
$aluno1->aumentarNota(10);

$aluno2->diminuirNota(20);

$aluno3->alterarTurma("3A");

echo "<br>";


// VERIFICAÇÕES
$aluno1->verificarAprovacao();

$aluno2->verificarAprovacao();

$aluno3->verificarAprovacao();

echo "<br>";


// COMPARAÇÕES
$aluno1->compararNotas($aluno2);

$aluno2->compararNotas($aluno3);

echo "<br>";