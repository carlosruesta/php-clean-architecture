<?php

namespace Alura\Arquitetura\Dominio\Aluno;

use Alura\Arquitetura\Dominio\Cpf;

/** Essa interface é o ponto de comunicacao entre o dominio e o mundo exterior
 * Uma entidade Aluno o máximo que vai conhecer será a interface.
 * Não conhecerá os detalhes da implementação desse repositório.
 * Nesta interface são definidos quais funcionalidades serão necessárias implementar nos repositorios
 * Essa interface define funcionalidades que permite o cara de negócios definir, sem importar a implementação
 * A pessoa de negócios não quer nem saber se será feito com PDO, DOctrine, MySql, Oracle, etc.
 */
interface RepositorioAluno
{
    public function adicionar(Aluno $aluno): void;

    public function buscarPorCpf(Cpf $cpf): Aluno;

    /** @return Aluno[] */
    public function buscarTodos(): array;
}