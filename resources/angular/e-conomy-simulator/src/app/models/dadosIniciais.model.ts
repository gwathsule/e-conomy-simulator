export class DadosIniciais {

    constructor(
        public populacao: number,
        public impostoRenda: number,
        public taxaJuros: number,
        public depositoCompulsório: number,
        public porcentagemEmpresas: number,
        public quantidadeBancos: number
    ) {
        this.populacao = populacao;
        this.impostoRenda = impostoRenda;
        this.taxaJuros = taxaJuros;
        this.depositoCompulsório = depositoCompulsório;
        this.porcentagemEmpresas = porcentagemEmpresas;
        this.quantidadeBancos = quantidadeBancos;
    }
}
