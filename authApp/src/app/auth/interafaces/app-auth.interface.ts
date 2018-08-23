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
