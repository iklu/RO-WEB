import {
  Directive,
  ElementRef,
  OnInit,
  Input,
  Output,
  EventEmitter,
  HostListener
} from '@angular/core';
import {CollectedStatusInterface, InputIdleInterface} from "./input-idle.interface";
import {AppAuthConstant} from "../../auth/interafaces/app-auth.constant";

@Directive({
  selector: '[input-idle]'
})
export class InputIdleDirective implements OnInit {

  @Input() inputType: string;
  @Input() minChars: number;
  @Input() maxChars: number;
  @Input() notAllowed: RegExp;

  @Output() inputStatus: EventEmitter<InputIdleInterface> = new EventEmitter<InputIdleInterface>();

  collectedStatus: CollectedStatusInterface = {
    status: 'indeterminate',
    inputType: undefined,
    value: null,
    errorMinChars: false,
    errorMaxChars: false,
    errorNotAllowed: false,
    hasError: false
  };

  validationRules: any = {
    minChars: this.minChars || 4,
    maxChars: this.maxChars || 10,
    notAllowed: this.notAllowed || /\s/g
  };

  inputValueCompare: string;
  timer: any;

  constructor( private el: ElementRef<HTMLInputElement> ) {}

  ngOnInit() {
    this.collectedStatus.inputType = this.inputType || undefined;
  }

  /**
   * On every keypress event we are going to detect if user is idling or not
   * like if after a period, the model hasn't changed we can assume the input is idle
   * send over the event if input is idle and fire up services to precheck data
   */
  @HostListener('document:keyup', ['$event']) onKeyUpHandle(ev: KeyboardEvent) {

    if (ev.keyCode === 27) {
      this.el.nativeElement.blur();

      return;
    }

    if(this.inputValueCompare === this.el.nativeElement.value ||
       document.activeElement !== this.el.nativeElement ||
       !this.collectedStatus.inputType) {
      return;
    }

    this.inputValueCompare = this.el.nativeElement.value;

    clearTimeout(this.timer);

    this.collectedStatus.value = this.el.nativeElement.value;

    this.collectedStatus.errorMinChars = false;
    this.collectedStatus.errorMaxChars = false;
    this.collectedStatus.errorNotAllowed = false;

    this.collectedStatus.status = 'active';

    this.inputStatus.emit(this.collectedStatus);

    this.timer = setTimeout(()=> {
      if (this.collectedStatus.value !== this.el.nativeElement.value) {
        return;
      }

      this.collectedStatus.status ='idle';
      this.collectedStatus.errorMinChars = this.el.nativeElement.value.length < this.validationRules.minChars;
      this.collectedStatus.errorMaxChars = this.collectedStatus.value.length > this.validationRules.maxChars;
      this.collectedStatus.errorNotAllowed = !!this.collectedStatus.value.match(this.validationRules.notAllowed);

      this.collectedStatus.hasError = this.collectedStatus.errorMinChars ||
                                      this.collectedStatus.errorMaxChars ||
                                      this.collectedStatus.errorNotAllowed;

      this.inputStatus.emit(this.collectedStatus);

    }, 1500);
  }
}
