package community.dddtw.refactor.complete;

public class PayCalculator {
    private final int WEDNESDAY = 3;

    private WorkingWeek workingWeek;
    public PayCalculator(WorkingWeek workingWeek) {
        this.workingWeek = workingWeek.setDoubleTime(WEDNESDAY);
    }

    public int calculatePay() {
        return this.workingWeek.regularHours() * 200 + this.workingWeek.overtimeHours() * 350;
    }

}
