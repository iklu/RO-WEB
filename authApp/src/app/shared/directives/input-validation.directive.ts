import {
  Directive,
  ElementRef,
  OnInit,
  Input,
  Output,
  EventEmitter,
  HostListener
} from '@angular/core';
import { InputIdleInterface } from "./input-idle.interface";
import {AppAuthConstant} from "../../auth/interafaces/app-auth.constant";

@Directive({
  selector: '[input-validation]'
})
export class InputValidationDirective implements OnInit {

  @Input() inputData: string;
  @Input() minChars: number;
  // minChars
  // value
  // idle
  // active

  @Output() inputValidationData: EventEmitter<InputIdleInterface> = new EventEmitter<InputIdleInterface>();

  constructor( private el: ElementRef ) {}

  ngOnInit() {
  }

  checkData(event) {

  }
}
