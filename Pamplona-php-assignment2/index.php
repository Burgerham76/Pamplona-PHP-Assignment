<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Grade Calculator</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<section class="activity-section">
    <h2>📊 Activity 2: Grade Calculator System (NEW GRADING)</h2>
    
    <?php

    function calculateAverage($midterm, $final) {
        return ($midterm + $final) / 2;
    }

    function getEquivalentGrade($average) {
        if ($average >= 96 && $average <= 100) return "4.0";
        elseif ($average >= 90 && $average <= 95) return "3.5";
        elseif ($average >= 84 && $average <= 89) return "3.0";
        elseif ($average >= 78 && $average <= 83) return "2.5";
        elseif ($average >= 72 && $average <= 77) return "2.0";
        elseif ($average >= 66 && $average <= 71) return "1.5";
        elseif ($average >= 60 && $average <= 65) return "1.0";
        else return "R";
    }

    function getRemark($gradePoint) {
        if ($gradePoint == "R") return "REPEAT";
        elseif ($gradePoint >= 1.0) return "PASSED";
        else return "INCOMPLETE";
    }

    function validateGrade($grade) {
        if (!is_numeric($grade)) return false;
        $grade = floatval($grade);
        return ($grade >= 0 && $grade <= 100);
    }

    function getGradeDescription($gradePoint) {
        switch($gradePoint) {
            case "4.0": return "Excellent";
            case "3.5": return "Very Good";
            case "3.0": return "Good";
            case "2.5": return "Satisfactory";
            case "2.0": return "Fair";
            case "1.5": return "Passing";
            case "1.0": return "Minimum Passing";
            case "R": return "Repeat";
            default: return "N/A";
        }
    }

    $gradeErrors = [];
    $gradeSubmitted = false;
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['calculateGrade'])) {
        $studentId = htmlspecialchars(trim($_POST['studentId'] ?? ''));
        $studentName = htmlspecialchars(trim($_POST['studentName'] ?? ''));
        $section = htmlspecialchars(trim($_POST['section'] ?? ''));
        $subject = htmlspecialchars(trim($_POST['subject'] ?? ''));
        $midtermGrade = htmlspecialchars(trim($_POST['midtermGrade'] ?? ''));
        $finalGrade = htmlspecialchars(trim($_POST['finalGrade'] ?? ''));

        if (empty($studentId)) $gradeErrors[] = "Student ID is required";
        if (empty($studentName)) $gradeErrors[] = "Student Name is required";
        if (empty($section)) $gradeErrors[] = "Section is required";
        if (empty($subject)) $gradeErrors[] = "Subject is required";
        
        if (empty($midtermGrade)) {
            $gradeErrors[] = "Midterm Grade is required";
        } elseif (!validateGrade($midtermGrade)) {
            $gradeErrors[] = "Midterm Grade must be between 0-100";
        }
        
        if (empty($finalGrade)) {
            $gradeErrors[] = "Final Grade is required";
        } elseif (!validateGrade($finalGrade)) {
            $gradeErrors[] = "Final Grade must be between 0-100";
        }
        
        if (empty($gradeErrors)) {
            $midtermGrade = floatval($midtermGrade);
            $finalGrade = floatval($finalGrade);
            $averageGrade = calculateAverage($midtermGrade, $finalGrade);
            $equivalentGrade = getEquivalentGrade($averageGrade);
            $remark = getRemark($equivalentGrade);
            $gradeDescription = getGradeDescription($equivalentGrade);
            $gradeSubmitted = true;
        }
    }
    ?>
    <div class="grade-calculator">
        <?php if (!$gradeSubmitted): ?>
            <form method="POST" action="" class="grade-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="studentId">Student ID *</label>
                        <input type="text" id="studentId" name="studentId" 
                               value="<?php echo $_POST['studentId'] ?? ''; ?>" required 
                               placeholder="e.g., 2024-1031562">
                    </div>
                    
                    <div class="form-group">
                        <label for="studentName">Student Name *</label>
                        <input type="text" id="studentName" name="studentName" 
                               value="<?php echo $_POST['studentName'] ?? ''; ?>" required 
                               placeholder="Lastname, Firstname">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="section">Section *</label>
                        <input type="text" id="section" name="section" 
                               value="<?php echo $_POST['section'] ?? ''; ?>" required 
                               placeholder="e.g., IT241">
                    </div>
                    
                    <div class="form-group">
                        <label for="subject">Subject *</label>
                        <input type="text" id="subject" name="subject" 
                               value="<?php echo $_POST['subject'] ?? ''; ?>" required 
                               placeholder="e.g., Web Development">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="midtermGrade">Midterm Grade (0-100) *</label>
                        <input type="number" id="midtermGrade" name="midtermGrade" 
                               value="<?php echo $_POST['midtermGrade'] ?? ''; ?>" required 
                               min="0" max="100" step="0.01" 
                               placeholder="Enter midterm grade">
                    </div>
                    
                    <div class="form-group">
                        <label for="finalGrade">Final Grade (0-100) *</label>
                        <input type="number" id="finalGrade" name="finalGrade" 
                               value="<?php echo $_POST['finalGrade'] ?? ''; ?>" required 
                               min="0" max="100" step="0.01" 
                               placeholder="Enter final grade">
                    </div>
                </div>
                
                <div class="form-actions">
                    <button type="submit" name="calculateGrade" class="calculate-btn">
                        Calculate Grades
                    </button>
                </div>
                
                <?php if (!empty($gradeErrors)): ?>
                    <div class="error-box">
                        <h3>Please fix the following errors:</h3>
                        <ul>
                            <?php foreach ($gradeErrors as $error): ?>
                                <li><?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </form>
        <?php else: ?>
            <div class="results-box">
                <h3>📊 Grade Computation Results</h3>
                
                <div class="student-info-card">
                    <h4>Student Information</h4>
                    <table>
                        <tr>
                            <td><strong>Student ID:</strong></td>
                            <td><?php echo $studentId; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Name:</strong></td>
                            <td><?php echo $studentName; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Section:</strong></td>
                            <td><?php echo $section; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Subject:</strong></td>
                            <td><?php echo $subject; ?></td>
                        </tr>
                    </table>
                </div>
                
                <div class="grades-card">
                    <h4>Grade Computation</h4>
                    <table class="grades-table">
                        <tr>
                            <td>Midterm Grade:</td>
                            <td><?php echo number_format($midtermGrade, 2); ?>%</td>
                        </tr>
                        <tr>
                            <td>Final Grade:</td>
                            <td><?php echo number_format($finalGrade, 2); ?>%</td>
                        </tr>
                        <tr>
                            <td><strong>Average Grade:</strong></td>
                            <td><strong><?php echo number_format($averageGrade, 2); ?>%</strong></td>
                        </tr>
                        <tr>
                            <td>Grade Point:</td>
                            <td class="grade-point"><?php echo $equivalentGrade; ?></td>
                        </tr>
                        <tr>
                            <td>Description:</td>
                            <td class="grade-description"><?php echo $gradeDescription; ?></td>
                        </tr>
                        <tr>
                            <td>Remark:</td>
                            <td class="remark <?php echo strtolower($remark); ?>"><?php echo $remark; ?></td>
                        </tr>
                    </table>
                </div>
                
                <div class="grading-system">
                    <table>
                        <thead>
                            <tr>
                                <th>% Grade Range</th>
                                <th>Grade Point</th>
                                <th>Description</th>
                                <th>Remark</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="<?php echo ($averageGrade >= 96 && $averageGrade <= 100) ? 'current-grade' : ''; ?>">
                                <td>96 - 100</td>
                                <td>4.0</td>
                                <td>Excellent</td>
                                <td>PASSED</td>
                            </tr>
                            <tr class="<?php echo ($averageGrade >= 90 && $averageGrade <= 95) ? 'current-grade' : ''; ?>">
                                <td>90 - 95</td>
                                <td>3.5</td>
                                <td>Very Good</td>
                                <td>PASSED</td>
                            </tr>
                            <tr class="<?php echo ($averageGrade >= 84 && $averageGrade <= 89) ? 'current-grade' : ''; ?>">
                                <td>84 - 89</td>
                                <td>3.0</td>
                                <td>Good</td>
                                <td>PASSED</td>
                            </tr>
                            <tr class="<?php echo ($averageGrade >= 78 && $averageGrade <= 83) ? 'current-grade' : ''; ?>">
                                <td>78 - 83</td>
                                <td>2.5</td>
                                <td>Satisfactory</td>
                                <td>PASSED</td>
                            </tr>
                            <tr class="<?php echo ($averageGrade >= 72 && $averageGrade <= 77) ? 'current-grade' : ''; ?>">
                                <td>72 - 77</td>
                                <td>2.0</td>
                                <td>Fair</td>
                                <td>PASSED</td>
                            </tr>
                            <tr class="<?php echo ($averageGrade >= 66 && $averageGrade <= 71) ? 'current-grade' : ''; ?>">
                                <td>66 - 71</td>
                                <td>1.5</td>
                                <td>Passing</td>
                                <td>PASSED</td>
                            </tr>
                            <tr class="<?php echo ($averageGrade >= 60 && $averageGrade <= 65) ? 'current-grade' : ''; ?>">
                                <td>60 - 65</td>
                                <td>1.0</td>
                                <td>Minimum Passing</td>
                                <td>PASSED</td>
                            </tr>
                            <tr class="<?php echo ($averageGrade < 60) ? 'current-grade' : ''; ?>">
                                <td>59 and below</td>
                                <td>R</td>
                                <td>Repeat</td>
                                <td>REPEAT</td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="system-note"><strong>Note:</strong> Highlighted row shows your current grade range.</p>
                </div>
                
                <a href="" class="back-btn">Calculate Again</a>
            </div>
        <?php endif; ?>
    </div>
</section>

</body>
</html>