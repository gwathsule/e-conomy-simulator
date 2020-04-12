import { Component, OnInit } from '@angular/core';
import { DadosIniciais } from '../models/dadosIniciais.model';

@Component({
  selector: 'pagina-inicial',
  templateUrl: './pagina-inicial.component.html',
  styleUrls: ['./pagina-inicial.component.css']
})
export class PaginaInicialComponent implements OnInit {

  dadosIniciais: DadosIniciais = new DadosIniciais(1500, 0.1, 0.04, 0.5, 0.1, 4);
  constructor() { }

  ngOnInit(): void {
    console.log(this.dadosIniciais);
  }

}
