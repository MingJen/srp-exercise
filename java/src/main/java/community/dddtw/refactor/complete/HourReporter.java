package community.dddtw.refactor.complete;

public class HourReporter {
    private WorkingWeek workingWeek;

    public HourReporter(WorkingWeek workingWeek) {
        this.workingWeek = workingWeek;
    }

    public String reportHours() {
        return "Regular Hours: " + this.workingWeek.regularHours();
    }
}
