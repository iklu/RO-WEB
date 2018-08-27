export interface AppAuthLoginInterface {
  username: string;
  password: string;
}

export interface AppAuhLoginBehaviourInterface {
  show: boolean;
  message?: string;
}

export interface AppAuthRegisterInterface {
  username: string;
  password: string;
  matchingPassword: string;
  email: string;
  firstName: string;
  lastName: string;
}

export interface AppAuhRegisterBehaviourInterface {
  show: boolean;
  message?: string;
  messageExistingUsername?: string;
  messageExistingEmailAddress?: string;
}

export interface AppAuthInterfaceLoginSuccessEvent {
  access_token: string;
  expires_in: number;
  scope: string;
  token_type: string;
  userName: string;
}
