export interface InputIdleInterface {
  status?: string,
  modelValue?: string,
  type?: string
}

export interface CollectedStatusInterface {
  status: string,
  inputType: string,
  value: string,
  errorMinChars: boolean,
  errorMaxChars: boolean,
  errorNotAllowed: boolean,
  hasError: boolean
}
