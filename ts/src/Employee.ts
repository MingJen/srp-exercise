const assert = require('assert').strict

export class Employee {
  public workHours: number[]
  public name: string

  constructor(name: string, workHours: number[]) {
    assert.ok(
      workHours.filter((hour) => Number.isInteger(hour)).length ===
        workHours.length,
      new Error('工時資料應該為數字')
    )
    assert.ok(workHours.length === 7, new Error('應該要有一週的工時資料'))
    assert.ok(
      assertRange(0, 16)(workHours),
      new Error('工時資料應該為 0 - 16 的數字')
    )

    this.name = name
    this.workHours = workHours
  }

  // CFO
  public calculatePay(): number {
    return this.regularHours * 200 + this.overtimeHours * 350
  }

  // COO
  public reportHours(): string {
    return `Regular Hours: ${this.regularHours}`
  }

  // CTO
  public save() {
    return `saved`
  }

  private get regularHours(): number {
    return this.workHours.reduce((acc, hour, index) => {
      if (index === 0 || index === 6) {
        return acc
      }

      return acc + Math.min(hour, 8)
    }, 0)
  }

  private get overtimeHours(): number {
    const workdays = [1, 2, 3, 4, 5]
    return this.workHours.reduce((acc, hour, index) => {
      const isWorkDay = !!workdays.find((day) => day === index)
      if (isWorkDay) {
        return acc + Math.max(hour - 8, 0)
      } else {
        return acc + hour
      }
    }, 0)
  }
}

const assertRange = (start: number, end: number) => (arr: number[]) =>
  arr.filter((v) => v >= start && v <= end).length === arr.length
