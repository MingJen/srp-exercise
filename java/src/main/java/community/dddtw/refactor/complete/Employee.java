package community.dddtw.refactor.complete;

public class Employee {
    public int[] workHours;
    public String name;

    private PayCalculator payCalculator;
    private HourReporter hourReporter;
    private WorkingWeek workingWeek;

    public Employee(String name, int[] workHours) {
        if (workHours.length != 7) {
            throw new IllegalArgumentException("應該要有一週的工時資料");
        }
        for (int workHour : workHours) {
            if (workHour < 0 || workHour > 16) {
                throw new IllegalArgumentException("工時資料應該為 0 - 16 的數字");
            }
        }

        this.workHours = workHours;
        this.name = name;

        this.workingWeek = new WorkingWeek(workHours);
        this.payCalculator = new PayCalculator(workingWeek);
        this.hourReporter = new HourReporter(workingWeek);
    }



    // CFO
    public int calculatePay() {
//        return this.regularHours() * 200 + this.overtimeHours() * 350;
        return this.payCalculator.calculatePay();
    }

    // COO
    public String reportHours() {
        return this.hourReporter.reportHours();
    }

    // CTO
    public String save() {
        return "saved";
    }
}


