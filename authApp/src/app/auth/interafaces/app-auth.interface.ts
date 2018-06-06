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
