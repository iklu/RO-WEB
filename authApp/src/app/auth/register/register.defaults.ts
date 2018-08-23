export class InputValidationStatus {
  static errorMinChars: boolean = false;
  static errorMaxChars: boolean = false;
  static errorNotAllowed: boolean = false;
  static errorUsername: boolean = false;
  static userNameSucces: boolean = false;
  static loading: boolean = false;
}

export class InputValidationEvent {
  status: string;
  inputType: string;
  value: string;
  errorMinChars: boolean;
  errorMaxChars: boolean;
  errorNotAllowed: boolean;
  hasError: boolean
}
