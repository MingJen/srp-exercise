import { Employee } from './Employee'

const employee = new Employee('John', [4, 9, 8, 5, 9, 9, 7])

test('Throw if there is any non-integer data in work hours', () => {
  expect(() => {
    new Employee('John', [4, 9, 8.5, 5, 9, 9, 7])
  }).toThrow()
})

test('Throw if there are no whole week data of work hours', () => {
  expect(() => {
    new Employee('John', [8])
  }).toThrow()
})

test('Throw if there is any out of range hour in work hours', () => {
  expect(() => {
    new Employee('John', [7, 7, 7, 18, 7, 7, 7])
  }).toThrow()
})

test('Report regular work hours', () => {
  expect(employee.reportHours()).toBe('Regular Hours: 37')
})

test('Calculate pay', () => {
  expect(employee.calculatePay()).toBe(12300)
})
