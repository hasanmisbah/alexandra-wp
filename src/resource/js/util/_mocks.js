import { faker } from '@faker-js/faker';

export const contacts = (count = 50) => {
  return [...Array(count)].map(() => ({
    id: faker.random.numeric(),
    name: faker.name.fullName(),
    phone: faker.phone.number(),
    email: faker.internet.email(),
    message: faker.lorem.paragraph(),
  }));
};
