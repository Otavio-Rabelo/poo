<?php

/*
==========================================================
        MODELO CORINGA - POO PHP
==========================================================

CONCEITOS:

[1] Encapsulamento
    private
    getters
    setters

[2] Construtor
    __construct()
    $this

[3] Herança
    extends

[4] Construtor da classe pai
    parent::__construct()

[5] Classe abstrata
    abstract class

[6] Método abstrato
    abstract public function ...

[7] Polimorfismo
    Mesmo método nas classes filhas
    Cada classe implementa de uma maneira

[8] Vetor de objetos
    array contendo objetos

[9] Agregação
    Uma classe recebe objetos que já existem

[10] Composição
     Uma classe cria seus próprios objetos internos

==========================================================
*/


// ========================================================
// CLASSE ABSTRATA / CLASSE PAI
// ========================================================

abstract class Funcionario
{
    // ====================================================
    // ENCAPSULAMENTO
    // Os atributos ficam PRIVATE
    // ====================================================

    private string $nome;
    private string $cpf;
    private float $salarioBase;


    // ====================================================
    // CONSTRUTOR
    //
    // Quando fizer:
    //
    // $obj = new Funcionario(...);
    //
    // o construtor é executado.
    //
    // ATENÇÃO:
    // $this->nome = $nome;
    //
    // esquerda  = atributo do OBJETO
    // direita   = parâmetro recebido
    // ====================================================

    public function __construct(
        string $nome,
        string $cpf,
        float $salarioBase
    ) {
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->salarioBase = $salarioBase;
    }


    // ====================================================
    // GETTERS
    // Servem para LER os atributos private
    // ====================================================

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }

    public function getSalarioBase(): float
    {
        return $this->salarioBase;
    }


    // ====================================================
    // SETTERS
    // Servem para ALTERAR os atributos private
    // ====================================================

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function setCpf(string $cpf): void
    {
        $this->cpf = $cpf;
    }

    public function setSalarioBase(float $salarioBase): void
    {
        $this->salarioBase = $salarioBase;
    }


    // ====================================================
    // MÉTODO ABSTRATO
    //
    // Cada classe filha DEVE implementar esse método.
    //
    // Isso será usado no POLIMORFISMO.
    // ====================================================

    abstract public function calcularSalario(): float;
}



// ========================================================
// CLASSE FILHA 1
// HERANÇA
// ========================================================

class Professor extends Funcionario
{
    // Atributos específicos do Professor

    private string $disciplina;
    private int $horasExtras;


    // ====================================================
    // CONSTRUTOR DA CLASSE FILHA
    //
    // parent::__construct()
    // chama o construtor da classe PAI.
    // ====================================================

    public function __construct(
        string $nome,
        string $cpf,
        float $salarioBase,
        string $disciplina,
        int $horasExtras
    ) {

        // Inicializa os atributos herdados

        parent::__construct(
            $nome,
            $cpf,
            $salarioBase
        );


        // Inicializa os atributos próprios

        $this->disciplina = $disciplina;
        $this->horasExtras = $horasExtras;
    }


    // ====================================================
    // GET / SET
    // ====================================================

    public function getDisciplina(): string
    {
        return $this->disciplina;
    }

    public function setDisciplina(string $disciplina): void
    {
        $this->disciplina = $disciplina;
    }

    public function getHorasExtras(): int
    {
        return $this->horasExtras;
    }

    public function setHorasExtras(int $horasExtras): void
    {
        $this->horasExtras = $horasExtras;
    }


    // ====================================================
    // POLIMORFISMO
    //
    // O método tem o MESMO NOME da classe pai.
    //
    // Mas o Professor calcula de uma maneira diferente.
    // ====================================================

    public function calcularSalario(): float
    {
        return $this->getSalarioBase()
             + ($this->horasExtras * 50);
    }
}



// ========================================================
// CLASSE FILHA 2
// ========================================================

class Tecnico extends Funcionario
{
    private float $adicional;


    // ====================================================
    // CONSTRUTOR
    // ====================================================

    public function __construct(
        string $nome,
        string $cpf,
        float $salarioBase,
        float $adicional
    ) {

        parent::__construct(
            $nome,
            $cpf,
            $salarioBase
        );

        $this->adicional = $adicional;
    }


    // ====================================================
    // GET / SET
    // ====================================================

    public function getAdicional(): float
    {
        return $this->adicional;
    }

    public function setAdicional(float $adicional): void
    {
        $this->adicional = $adicional;
    }


    // ====================================================
    // POLIMORFISMO
    //
    // Mesmo método:
    //
    // calcularSalario()
    //
    // Porém, cálculo diferente.
    // ====================================================

    public function calcularSalario(): float
    {
        return $this->getSalarioBase()
             + $this->adicional;
    }
}



// ========================================================
// COMPOSIÇÃO
// ========================================================

/*
    COMPOSIÇÃO:

    Uma classe possui outra como parte dela.

    Exemplo:

    Pedido
       |
       +--- ItemPedido
       +--- ItemPedido

    O Pedido pode criar seus próprios itens.

    PISTA IMPORTANTE:

    new ItemPedido() DENTRO da classe.
*/


class ItemPedido
{
    private string $produto;
    private int $quantidade;

    public function __construct(
        string $produto,
        int $quantidade
    ) {
        $this->produto = $produto;
        $this->quantidade = $quantidade;
    }

    public function getProduto(): string
    {
        return $this->produto;
    }

    public function getQuantidade(): int
    {
        return $this->quantidade;
    }
}


class Pedido
{
    private array $itens;


    public function __construct()
    {
        $this->itens = [];
    }


    // ====================================================
    // COMPOSIÇÃO
    //
    // O próprio Pedido cria o ItemPedido.
    // ====================================================

    public function adicionarItem(
        string $produto,
        int $quantidade
    ): void {

        $this->itens[] = new ItemPedido(
            $produto,
            $quantidade
        );
    }


    public function getItens(): array
    {
        return $this->itens;
    }
}



// ========================================================
// AGREGAÇÃO
// ========================================================

/*
    AGREGAÇÃO:

    Um objeto recebe outro objeto que JÁ EXISTE.

    Exemplo:

    $professor = new Professor(...);

    $empresa->adicionarFuncionario($professor);

    O Professor foi criado FORA da Empresa.

    PISTA:

    Classe recebe um objeto como parâmetro.
*/


class Empresa
{
    private string $nome;

    // VETOR DE OBJETOS
    private array $funcionarios;


    public function __construct(string $nome)
    {
        $this->nome = $nome;
        $this->funcionarios = [];
    }


    // ====================================================
    // AGREGAÇÃO
    //
    // Recebe um Funcionario já criado.
    //
    // Como Professor e Tecnico HERDAM de Funcionario,
    // podemos passar objetos dessas classes.
    // ====================================================

    public function adicionarFuncionario(
        Funcionario $funcionario
    ): void {

        $this->funcionarios[] = $funcionario;
    }


    public function getFuncionarios(): array
    {
        return $this->funcionarios;
    }


    public function getNome(): string
    {
        return $this->nome;
    }
}



// ========================================================
// INDEX / TESTES
// ========================================================


// ========================================================
// CRIANDO OBJETOS
// ========================================================

$professor = new Professor(
    "Carlos",
    "123456789",
    3000,
    "Programacao",
    10
);


$tecnico = new Tecnico(
    "Joao",
    "987654321",
    2500,
    400
);



// ========================================================
// VETOR DE OBJETOS
// ========================================================

$funcionarios = [];

$funcionarios[] = $professor;
$funcionarios[] = $tecnico;



// ========================================================
// POLIMORFISMO + VETOR DE OBJETOS
// ========================================================

/*
    Aqui está uma das partes MAIS IMPORTANTES.

    O vetor possui:

    Professor
    Tecnico

    Ambos são Funcionario.

    O método calcularSalario() será chamado
    de acordo com o tipo real do objeto.
*/

foreach ($funcionarios as $funcionario) {

    echo "Nome: "
        . $funcionario->getNome()
        . "<br>";

    echo "CPF: "
        . $funcionario->getCpf()
        . "<br>";

    echo "Salario base: R$ "
        . $funcionario->getSalarioBase()
        . "<br>";

    echo "Salario final: R$ "
        . $funcionario->calcularSalario()
        . "<br>";

    echo "<hr>";
}



// ========================================================
// USANDO SETTERS
// ========================================================

// ALTERAR VALORES:

$professor->setNome("Pedro");

$professor->setDisciplina("Banco de Dados");

$professor->setHorasExtras(20);

$tecnico->setAdicional(700);


// ========================================================
// MOSTRANDO VALORES ALTERADOS
// ========================================================

echo "<h2>Depois das alterações</h2>";

echo "Professor: "
    . $professor->getNome()
    . "<br>";

echo "Disciplina: "
    . $professor->getDisciplina()
    . "<br>";

echo "Horas extras: "
    . $professor->getHorasExtras()
    . "<br>";

echo "Novo salario: R$ "
    . $professor->calcularSalario()
    . "<br>";

echo "<hr>";

echo "Tecnico: "
    . $tecnico->getNome()
    . "<br>";

echo "Adicional: R$ "
    . $tecnico->getAdicional()
    . "<br>";

echo "Novo salario: R$ "
    . $tecnico->calcularSalario()
    . "<br>";



// ========================================================
// AGREGAÇÃO
// ========================================================

$empresa = new Empresa("Empresa X");


// Os objetos JÁ EXISTEM

$empresa->adicionarFuncionario($professor);

$empresa->adicionarFuncionario($tecnico);


// Agora a Empresa possui esses funcionários no vetor


echo "<h2>Funcionarios da empresa</h2>";

foreach ($empresa->getFuncionarios() as $funcionario) {

    echo $funcionario->getNome()
        . " - R$ "
        . $funcionario->calcularSalario()
        . "<br>";
}



// ========================================================
// COMPOSIÇÃO
// ========================================================

$pedido = new Pedido();


// O próprio Pedido cria os ItemPedido

$pedido->adicionarItem("Teclado", 2);

$pedido->adicionarItem("Mouse", 3);

$pedido->adicionarItem("Monitor", 1);


// Mostrar os itens

echo "<h2>Itens do pedido</h2>";

foreach ($pedido->getItens() as $item) {

    echo "Produto: "
        . $item->getProduto()
        . "<br>";

    echo "Quantidade: "
        . $item->getQuantidade()
        . "<br>";

    echo "<hr>";
}

?>