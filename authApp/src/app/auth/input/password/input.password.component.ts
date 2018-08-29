import {Component, Output, Input, EventEmitter, ViewChild, ElementRef} from '@angular/core';

@Component({
  selector: '[app__input--password]',
  templateUrl: './input.password.component.html'
})


export class InputPasswordComponent {
  @Input() model: string;

  @Input() labelFor: string;
  @Input() labelClassName: string;
  @Input() inputPlaceholder: string;
  @Input() inputClassName: string;
  @Input() rules: RegExp;
  @Input() showPassword: boolean;

  @Output() inputStatus: EventEmitter<any> = new EventEmitter();
  @Output() updateInputValue: EventEmitter<KeyboardEvent> = new EventEmitter<KeyboardEvent>();

  @ViewChild('inputPassword') inputPassword: ElementRef;

  sendInputStatus(event: KeyboardEvent) {
    this.inputStatus.emit(event);
  }

  toggleInputType() {
    this.inputPassword.nativeElement.type = this.inputPassword.nativeElement.type === 'text' ? 'password' : 'text';
  }
}
