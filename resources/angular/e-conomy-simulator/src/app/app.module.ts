import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { PaginaInicialComponent } from './pagina-inicial/pagina-inicial.component';
import { PaginaInicialFormComponent } from './pagina-inicial/pagina-inicial-form/pagina-inicial-form.component';

@NgModule({
  declarations: [
    AppComponent,
    PaginaInicialComponent,
    PaginaInicialFormComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
