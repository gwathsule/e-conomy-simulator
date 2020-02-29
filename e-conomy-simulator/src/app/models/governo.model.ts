export class Governo {

    constructor(
        public id?: number,
        public gasto?: number,
        public receita?: number,
        public impostoRenda?: number,
        public taxaDeJuros?: number,
        public taxaDepositoCompulsorio?: number
    ) {}
}