<?php

/*

CONCEITOS PRESENTES:

1. Classe abstrata
2. Encapsulamento
3. Atributos private
4. Construtor
5. $this
6. Getters
7. Setters
8. Herança - extends
9. parent::__construct()
10. Métodos abstratos
11. Polimorfismo
12. Vetor de objetos
13. foreach
14. Métodos próprios das classes filhas
15. Validações com if
16. Cálculos
17. Objetos sendo criados com new

==========================================================
*/


// ========================================================
// CLASSE PAI / ABSTRATA
// ========================================================

abstract class Produto
{
    // ----------------------------------------------------
    // ATRIBUTOS
    // Se a questão pedir encapsulamento:
    // use PRIVATE
    // ----------------------------------------------------

    private int $codigo;
    private string $nome;
    private string $descricao;
    private float $precoBase;
    private int $quantidadeEstoque;
    private bool $isAtivo;


    // ====================================================
    // CONSTRUTOR
    // ====================================================

    public function __construct(
        int $codigo,
        string $nome,
        string $descricao,
        float $precoBase,
        int $quantidadeEstoque
    ) {

        // $this->atributo = parâmetro

        $this->codigo = $codigo;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->precoBase = $precoBase;
        $this->quantidadeEstoque = $quantidadeEstoque;

        // Regra do enunciado:
        // estoque > 0 = ativo

        $this->isAtivo = $quantidadeEstoque > 0;
    }


    // ====================================================
    // GETTERS
    // ====================================================

    public function getCodigo(): int
    {
        return $this->codigo;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function getPrecoBase(): float
    {
        return $this->precoBase;
    }

    public function getQuantidadeEstoque(): int
    {
        return $this->quantidadeEstoque;
    }

    public function getIsAtivo(): bool
    {
        return $this->isAtivo;
    }


    // ====================================================
    // SETTERS
    // ====================================================

    public function setCodigo(int $codigo): void
    {
        $this->codigo = $codigo;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }

    public function setPrecoBase(float $precoBase): void
    {
        $this->precoBase = $precoBase;
    }

    public function setQuantidadeEstoque(int $quantidadeEstoque): void
    {
        $this->quantidadeEstoque = $quantidadeEstoque;
    }

    public function setIsAtivo(bool $isAtivo): void
    {
        $this->isAtivo = $isAtivo;
    }


    // ====================================================
    // MÉTODO - ADICIONAR ESTOQUE
    // ====================================================

    public function adicionarEstoque(int $quantidade): void
    {
        if ($quantidade > 0) {

            $this->quantidadeEstoque += $quantidade;

            // Se entrou estoque, fica ativo

            $this->isAtivo = true;
        }
    }


    // ====================================================
    // MÉTODO - BAIXAR ESTOQUE
    // ====================================================

    public function baixarEstoque(int $quantidade): void
    {
        if (
            $quantidade > 0 &&
            $quantidade <= $this->quantidadeEstoque
        ) {

            $this->quantidadeEstoque -= $quantidade;

            // Se acabou o estoque:

            if ($this->quantidadeEstoque == 0) {

                $this->isAtivo = false;
            }
        }
    }


    // ====================================================
    // MÉTODO - DESCONTO
    // ====================================================

    public function aplicarDesconto(float $percentual): void
    {
        if (
            $percentual >= 0 &&
            $percentual <= 90
        ) {

            /*
                Fórmula:

                desconto =
                preço × percentual / 100
            */

            $desconto =
                $this->precoBase *
                ($percentual / 100);

            $this->precoBase -= $desconto;
        }
    }


    // ====================================================
    // MÉTODOS ABSTRATOS
    //
    // As classes filhas serão OBRIGADAS
    // a implementar esses métodos.
    //
    // Isso também permite POLIMORFISMO.
    // ====================================================

    abstract public function calcularPrecoVenda(): float;

    abstract public function verificarDisponibilidade(): bool;
}



// ========================================================
// CLASSE FILHA 1
// PRODUTO FÍSICO
// ========================================================

class ProdutoFisico extends Produto
{
    // ----------------------------------------------------
    // ATRIBUTOS ESPECÍFICOS
    // ----------------------------------------------------

    private float $peso;
    private string $dimensoes;
    private float $frete;
    private string $transportadora;


    // ====================================================
    // CONSTRUTOR
    // ====================================================

    public function __construct(
        int $codigo,
        string $nome,
        string $descricao,
        float $precoBase,
        int $quantidadeEstoque,

        float $peso,
        string $dimensoes,
        float $frete,
        string $transportadora
    ) {

        // ------------------------------------------------
        // CHAMA O CONSTRUTOR DO PAI
        // ------------------------------------------------

        parent::__construct(
            $codigo,
            $nome,
            $descricao,
            $precoBase,
            $quantidadeEstoque
        );


        // ------------------------------------------------
        // ATRIBUTOS DA CLASSE FILHA
        // ------------------------------------------------

        $this->peso = $peso;
        $this->dimensoes = $dimensoes;
        $this->frete = $frete;
        $this->transportadora = $transportadora;
    }


    // ====================================================
    // GETTERS
    // ====================================================

    public function getPeso(): float
    {
        return $this->peso;
    }

    public function getDimensoes(): string
    {
        return $this->dimensoes;
    }

    public function getFrete(): float
    {
        return $this->frete;
    }

    public function getTransportadora(): string
    {
        return $this->transportadora;
    }


    // ====================================================
    // SETTERS
    // ====================================================

    public function setPeso(float $peso): void
    {
        $this->peso = $peso;
    }

    public function setDimensoes(string $dimensoes): void
    {
        $this->dimensoes = $dimensoes;
    }

    public function setFrete(float $frete): void
    {
        $this->frete = $frete;
    }

    public function setTransportadora(string $transportadora): void
    {
        $this->transportadora = $transportadora;
    }


    // ====================================================
    // POLIMORFISMO
    //
    // Mesmo método da classe pai,
    // MAS com cálculo diferente.
    // ====================================================

    public function calcularPrecoVenda(): float
    {
        /*
            EXEMPLO:

            preço base
            + frete
            + 5%
        */

        return $this->getPrecoBase()
             + $this->frete
             + ($this->getPrecoBase() * 0.05);
    }


    // ====================================================
    // POLIMORFISMO
    // ====================================================

    public function verificarDisponibilidade(): bool
    {
        return $this->getQuantidadeEstoque() > 0
            && $this->getIsAtivo();
    }


    // ====================================================
    // MÉTODO ESPECÍFICO
    // ====================================================

    public function calcularVolumeCubico(): float
    {
        /*
            Exemplo de dimensão:

            "30x20x10"

            explode separa:

            30
            20
            10
        */

        $medidas = explode(
            "x",
            strtolower($this->dimensoes)
        );


        if (count($medidas) != 3) {
            return 0;
        }


        $comprimento = (float)$medidas[0];
        $largura = (float)$medidas[1];
        $altura = (float)$medidas[2];


        return
            $comprimento *
            $largura *
            $altura;
    }
}



// ========================================================
// CLASSE FILHA 2
// PRODUTO DIGITAL
// ========================================================

class ProdutoDigital extends Produto
{
    private float $tamanhoArquivo;
    private string $formato;
    private int $limiteDownloads;
    private string $linkNuvem;


    // ====================================================
    // CONSTRUTOR
    // ====================================================

    public function __construct(
        int $codigo,
        string $nome,
        string $descricao,
        float $precoBase,
        int $quantidadeEstoque,

        float $tamanhoArquivo,
        string $formato,
        int $limiteDownloads,
        string $linkNuvem
    ) {

        parent::__construct(
            $codigo,
            $nome,
            $descricao,
            $precoBase,
            $quantidadeEstoque
        );


        $this->tamanhoArquivo = $tamanhoArquivo;
        $this->formato = $formato;
        $this->limiteDownloads = $limiteDownloads;
        $this->linkNuvem = $linkNuvem;
    }


    // ====================================================
    // GETTERS
    // ====================================================

    public function getTamanhoArquivo(): float
    {
        return $this->tamanhoArquivo;
    }

    public function getFormato(): string
    {
        return $this->formato;
    }

    public function getLimiteDownloads(): int
    {
        return $this->limiteDownloads;
    }

    public function getLinkNuvem(): string
    {
        return $this->linkNuvem;
    }


    // ====================================================
    // SETTERS
    // ====================================================

    public function setTamanhoArquivo(
        float $tamanhoArquivo
    ): void {

        $this->tamanhoArquivo =
            $tamanhoArquivo;
    }


    public function setFormato(
        string $formato
    ): void {

        $this->formato = $formato;
    }


    public function setLimiteDownloads(
        int $limiteDownloads
    ): void {

        $this->limiteDownloads =
            $limiteDownloads;
    }


    public function setLinkNuvem(
        string $linkNuvem
    ): void {

        $this->linkNuvem =
            $linkNuvem;
    }


    // ====================================================
    // POLIMORFISMO
    // ====================================================

    public function calcularPrecoVenda(): float
    {
        /*
            REGRA DO DIGITAL:

            preço base + 2
        */

        return $this->getPrecoBase() + 2;
    }


    // ====================================================
    // POLIMORFISMO
    // ====================================================

    public function verificarDisponibilidade(): bool
    {
        return $this->getIsAtivo()
            && !empty($this->linkNuvem);
    }


    // ====================================================
    // MÉTODO ESPECÍFICO
    // ====================================================

    public function gerarLink(string $idUsuario): string
    {
        /*
            Se a prova pedir MD5:

            md5("qualquer texto")

            gera uma string criptográfica.

            Exemplo:
        */

        $token = md5(
            $idUsuario .
            time() .
            $this->formato
        );


        return $this->linkNuvem
            . "?token="
            . $token;
    }
}



// ========================================================
// INDEX / TESTANDO O SISTEMA
// ========================================================


// ========================================================
// CRIANDO PRODUTO FÍSICO
// ========================================================

$livro = new ProdutoFisico(

    1,

    "Livro PHP",

    "Livro sobre PHP POO",

    100.00,

    10,

    0.8,

    "30x20x5",

    15.00,

    "Correios"
);



// ========================================================
// CRIANDO PRODUTO DIGITAL
// ========================================================

$curso = new ProdutoDigital(

    2,

    "Curso PHP",

    "Curso de PHP POO",

    150.00,

    1,

    2500,

    "mp4",

    5,

    "https://nuvem.com/download"
);



// ========================================================
// VETOR DE OBJETOS
// ========================================================

$produtos = [];

$produtos[] = $livro;
$produtos[] = $curso;



// ========================================================
// POLIMORFISMO
//
// NÃO precisamos saber se é:
// ProdutoFisico
// ou
// ProdutoDigital
//
// Ambos possuem calcularPrecoVenda()
// ========================================================

foreach ($produtos as $produto) {

    echo "<hr>";

    echo "Código: "
        . $produto->getCodigo()
        . "<br>";

    echo "Nome: "
        . $produto->getNome()
        . "<br>";

    echo "Preço Base: R$ "
        . number_format(
            $produto->getPrecoBase(),
            2,
            ",",
            "."
        )
        . "<br>";

    echo "Preço Venda: R$ "
        . number_format(
            $produto->calcularPrecoVenda(),
            2,
            ",",
            "."
        )
        . "<br>";


    echo "Disponível: ";


    if ($produto->verificarDisponibilidade()) {

        echo "SIM";

    } else {

        echo "NÃO";
    }


    echo "<br>";
}



// ========================================================
// ALTERANDO ATRIBUTOS
// ========================================================


// SETTER

$livro->setNome("Livro Completo PHP POO");


// MÉTODO

$livro->aplicarDesconto(10);


// ADICIONAR ESTOQUE

$livro->adicionarEstoque(5);


// BAIXAR ESTOQUE

$livro->baixarEstoque(2);


// MOSTRAR

echo "<hr>";

echo "Novo nome: "
    . $livro->getNome()
    . "<br>";

echo "Novo estoque: "
    . $livro->getQuantidadeEstoque()
    . "<br>";

echo "Novo preço: R$ "
    . number_format(
        $livro->getPrecoBase(),
        2,
        ",",
        "."
    )
    . "<br>";



// ========================================================
// MÉTODO ESPECÍFICO DA CLASSE FILHA
// ========================================================

echo "Volume: "
    . $livro->calcularVolumeCubico()
    . "<br>";



// ========================================================
// MÉTODO ESPECÍFICO DO PRODUTO DIGITAL
// ========================================================

echo "Link exclusivo:<br>";

echo $curso->gerarLink("aluno123");

?>