import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PaginaInicialFormComponent } from './pagina-inicial-form.component';

describe('PaginaInicialFormComponent', () => {
  let component: PaginaInicialFormComponent;
  let fixture: ComponentFixture<PaginaInicialFormComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PaginaInicialFormComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PaginaInicialFormComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
