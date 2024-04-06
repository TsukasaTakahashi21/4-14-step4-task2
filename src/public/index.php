<?php

class ExamResultChecker {
  private $examScoreLists;
  private $passingScores;

  public function __construct($examScoreLists, $passingScores) {
    $this->examScoreLists = $examScoreLists;
    $this->passingScores = $passingScores;
  }

  public function checkResults() {
    $resultList = [];

        foreach ($this->examScoreLists as $examineeNum => $examScoreList) {
            $pass = true;

            foreach ($examScoreList as $subject => $score) {
                if ($score < $this->passingScores[$subject]) {
                    $pass = false;
                    break; // 1つでも不合格ならばループを抜ける
                }
            }

            if ($pass) {
                $resultList[] = ($examineeNum + 1) . "番目の受験者は合格";
            } else {
                $resultList[] = ($examineeNum + 1) . "番目の受験者は不合格";
            }
          }

        return $resultList;
    }
}

$examScoreLists = [
  ["japanese" => 30, "math" => 30, "english" => 30],
  ["japanese" => 35, "math" => 41, "english" => 90],
  ["japanese" => 89, "math" => 40, "english" => 60],
  ["japanese" => 70, "math" => 70, "english" => 30]
];

$passingScores = ["japanese" => 35, "math" => 40, "english" => 31];

$checker = new ExamResultChecker($examScoreLists, $passingScores);
$results = $checker->checkResults();
echo implode("\n", $results);

?>