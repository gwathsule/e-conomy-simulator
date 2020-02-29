import { Governo } from './governo.model';
import { Banco } from './banco.model';
import { Conta } from './conta.model';
import { Contrato } from './contrato.model';
import { Empresa } from './empresa.model';
import { Emprestimo } from './emprestimo.model';
import { Familia } from './familia.model';
import { Pessoa } from './pessoa.model';
import { Titulo } from './titulo.model';

export class Game {

    constructor(
        public governo: Governo,
        public bancos: Banco[],
        public contas: Conta[],
        public contratos: Contrato[],
        public empresas: Empresa[],
        public emprestimos: Emprestimo[],
        public familias: Familia[],
        public pessoas: Pessoa[],
        public titulos: Titulo[]
    ) {
        this.bancos = [];
        this.contas = [];
        this.contratos = [];
        this.empresas = [];
        this.emprestimos = [];
        this.familias = [];
        this.pessoas = [];
        this.titulos = [];
    }
}