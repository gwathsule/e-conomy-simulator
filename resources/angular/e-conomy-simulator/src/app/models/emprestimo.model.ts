export class Emprestimo {

    constructor(
        public id?: number,
        public valorEmprestado?: number,
        public juros?: number,
        public parcelas?: number,
        public parcelasRestantes?: number,
        public valorMensal?: number,
        public tipoCredor?: number,
        public idFamilia?: number,
        public idEmpresa?: number
    ) {}
}