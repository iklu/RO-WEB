import { Directive, Input } from '@angular/core';

@Directive({
  selector: '[show-password]'
})

export class ShowPasswordDirective {
  @Input() className: string;
  @Input() showPasswordIcon: HTMLElement;
}
