package community.dddtw.refactor.complete;

import java.util.ArrayList;
import java.util.Arrays;

public class WorkingWeek {
    private int[] workHours;

    public WorkingWeek(int[] workHours) {
        this.workHours = workHours;
    }

    public WorkingWeek setDoubleTime(int weekDay) {
        int[] newWorkHours = new int[this.workHours.length];
        // int[] array = list.stream().mapToInt(i->i).toArray();
        for (int i = 0; i < this.workHours.length; i++) {
            int workHour = this.workHours[i];
            if (i == weekDay) {
                newWorkHours[i] = workHour * 2;
            } else {
                newWorkHours[i] = workHour;
            }
        }
        return new WorkingWeek(newWorkHours);

    }


    public int regularHours() {
        int hourCounter = 0;
        for (int i = 0; i < this.workHours.length; i++) {
            int workHour = this.workHours[i];
            if (i == 0 || i == 6) {
                continue;
            }
            hourCounter += Math.min(workHour, 8);
        }
        return hourCounter;
    }

    public int overtimeHours() {
        int hourCounter = 0;
        ArrayList<Integer> workDays = new ArrayList<Integer>(Arrays.asList(1, 2, 3, 4, 5));
        for (int i = 0; i < this.workHours.length; i++) {
            int workDay = i;
            int workHour = this.workHours[i];
            if (workDays.contains(workDay)) {
                hourCounter += Math.max(workHour - 8, 0);
            } else {
                hourCounter += workHour;
            }
        }
        return hourCounter;
    }
}
