import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { PaginaInicialFormComponent } from './pagina-inicial-form.component';



@NgModule({
  declarations: [PaginaInicialFormComponent],
  imports: [CommonModule, FormsModule],
  exports: [PaginaInicialFormComponent]
})
export class PaginaInicialFormModule { }
