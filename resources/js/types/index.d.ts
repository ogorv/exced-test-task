import { PaymentTypeEnum } from '@/enums/paymentType';

export interface Auth {
    user: User;
}

export type AppPageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
};

export interface User {
    login: string;
}

export type Payment = {
    amount: string;
    payment_type: PaymentTypeEnum;
    description: string;
    created_at: string;
}
