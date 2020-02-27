export class Titulo {

    constructor(
        public id?: number,
        public valorTitulo?: number,
        public valorFuturo?: number,
        public taxaDivida?: number,
        public tempoResgate?: number,
        public tempoResgateRestante?: number,
        public tipoCredor?: number,
        public idFamilia?: number,
        public idEmpresa?: number
    ) {}
}