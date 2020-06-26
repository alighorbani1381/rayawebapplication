<?php

namespace App\Repository;

use App\Category;
use App\Cost;
use App\Project;
use App\User;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Support\Facades\DB;

class ProjectRepository
{

    public static function createTaskMaster($request)
    {
        return  DB::table('project_taskmaster')
            ->insertGetId([
                'name' => $request->name,
                'lastname' => $request->lastname,
                'father_name' => $request->father_name,
                'meli_code' => $request->meli_code,
                'meli_image' => 'none',
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
    }

    public static function deleteTaskMaster($taskmasterId)
    {
        return  DB::table('project_taskmaster')
            ->where('project_id', $taskmasterId)
            ->delete();
    }

    public static function deleteContractors($projectId)
    {
        DB::table('project_contractor')
            ->where('project_id', $projectId)
            ->delete();
    }
    public static function deleteCategories($projectId)
    {
        DB::table('project_category')
            ->where('project_id', $projectId)
            ->delete();
    }

    public static function deleteProject($projectId)
    {
        DB::table('projects')
            ->where('project_id', $projectId)
            ->delete();
    }

    public function convertToEnglishAlphabet($string)
    {
        return strtr($string, array('۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4', '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9', '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4', '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9'));
    }

    public function explodeDate($orderdate)
    {
        $explodeDate = explode('-', $orderdate);
        $date[0]   = $explodeDate[0];
        $date[1] = $explodeDate[1];
        $date[2]  = $explodeDate[2];
        return $date;
    }

    public function convertToInt($date)
    {
        foreach ($date as $dateParam) {
            $englishCharacters[] = $this->convertToEnglishAlphabet($dateParam);
        }

        foreach ($englishCharacters as $englishChar) {
            $numberDate[] = (int) $englishChar;
        }

        return $numberDate;
    }

    public function getGregorianFormat($arrayDate)
    {
        return implode('-', $arrayDate);
    }

    public function convertToGregorian($jalaliDate)
    {
        $date = $this->explodeDate($jalaliDate);
        $numberDate = $this->convertToInt($date);
        $newDate = Verta::getGregorian($numberDate[0], $numberDate[1], $numberDate[2]);
        $gregorian = $this->getGregorianFormat($newDate);
        return $gregorian;
    }

    public function generateUniqueId()
    {

        while (true) {
            $uniqueId =  'raya' . '-' . substr(uniqid(), 4, 8);
            if (!$this->isExistsId($uniqueId))
                break;
        }

        return $uniqueId;
    }
    public function isExistsId($id)
    {
        $exists = Project::where('unique_id', $id)->count();
        if ($exists != 0)
            return true;
        else
            return false;
    }

    public function createProject($request, $taskmaster)
    {
        $dateStart = $this->convertToGregorian($request->date_start);
        $completedAt = $this->convertToGregorian($request->completed_at);
        $contractStarted = $this->convertToGregorian($request->contract_started);

        $dateTime = date('Y:m:d h:m');
        $uniqueId = $this->generateUniqueId();
        return DB::table('projects')->insertGetId([
            'project_creator' => '1',
            'taskmaster' => $taskmaster,
            'unique_id' => $uniqueId,
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'contract_image' => 'Default',
            'contract_started' => $contractStarted,
            'contract_ended' => $completedAt,
            'status' => 'waiting',
            'date_start' => $dateStart,
            'complete_after' => $request->complete_after,
            'created_at' => $dateTime,
            'updated_at' => $dateTime,
        ]);
    }

    public static function setContractors($projectId, $contractors)
    {
        foreach ($contractors as $contractor)
            DB::table('project_contractor')->insert([
                'project_id' => $projectId,
                'contractor_id' => $contractor,
            ]);
    }

    public static function setCategories($projectId, $categories)
    {
        foreach ($categories as $category)
            DB::table('project_category')->insert([
                'project_id' => $projectId,
                'category_id' => $category,
            ]);
    }

    public static function getProjects()
    {
        return DB::table('projects')
            ->join('project_taskmaster', 'projects.taskmaster', '=', 'project_taskmaster.id')
            ->orderBy('projects.id', 'desc')
            ->paginate(15);
    }

    public static function getActiveProjects()
    {
        return DB::table('projects')
            ->join('project_taskmaster', 'projects.taskmaster', '=', 'project_taskmaster.id')
            ->where('status', '!=', 'finished')
            ->orderBy('projects.id', 'desc')
            ->limit(6)
            ->get();
    }

    private function getLatestSixProject()
    {
        return DB::table('projects')
            ->join('project_taskmaster', 'projects.taskmaster', '=', 'project_taskmaster.id')
            ->orderBy('projects.id', 'desc')
            ->limit(6)
            ->get();
    }

    public function getLatestExecutedProject()
    {
        $projects = $this->getLatestSixProject();
        foreach ($projects as $project) {
            $project = $this->getProjectFull($project->id);
            $result[] = $project['project'];
        }
        return $result;
    }
    public function getStatisticProject()
    {
        $actives = $this->getActiveProjects();
        foreach ($actives as $active) {
            $project = $this->getProjectFull($active->id);
            $allProgress = $this->getProgress($project);
            $results['project'][] = $project['project'];
            $results['progress'][] = $allProgress;
        }
        return $results;
    }

    public static function getProject($id)
    {
        return DB::table('projects')
            ->join('project_taskmaster', 'projects.taskmaster', '=', 'project_taskmaster.id')
            ->where('projects.id', $id)
            ->first();
    }

    public static function getCategories($projectId)
    {
        return DB::table('project_category')
            ->join('categories', 'project_category.category_id', '=', 'categories.id')
            ->select('project_category.*', 'categories.title')
            ->where('project_category.project_id', $projectId)
            ->get();
    }

    public static function getProjectContractors($projectId)
    {
        return DB::table('project_contractor')
            ->where('project_contractor.project_id', $projectId)
            ->join('users', 'project_contractor.contractor_id', '=', 'users.id')
            ->select('users.id', 'users.name', 'users.lastname', 'users.profile', 'project_contractor.id AS contract_id', 'project_contractor.progress', 'project_contractor.progress_access')
            ->orderBy('project_contractor.progress_access', 'desc')
            ->get();
    }

    public function getEarnings($projectId)
    {
        return DB::table('projects')
            ->where('projects.id', $projectId)
            ->join('earnings', 'earnings.project_id', '=', 'projects.id')
            ->select('earnings.*')
            ->orderBy('earnings.created_at', 'desc')
            ->get();
    }

    public function projectCreateFull($request)
    {
        DB::transaction(function () use ($request) {
            $taskmaster = $this->createTaskMaster($request);
            $project = $this->createProject($request, $taskmaster);
            $this->setContractors($project, $request->contractors);
            $this->setCategories($project, $request->categories);
        });
    }

    public function getProjectFull($id)
    {
        Project::findOrFail($id);
        $project['project'] = $this->getProject($id);
        $project['categories'] = $this->getCategories($id);
        $project['contractors'] = $this->getProjectContractors($id);
        $project['earnings'] = $this->getEarnings($id);
        $project['base_costs'] = $this->getBaseProjectCosts($id);
        $project['contractor_costs'] = $this->getContractorCosts($id);
        return $project;
    }

    public function getBaseProjectCosts($id)
    {
        return Cost::where('project_id', $id)
            ->where('contractor_id', null)
            ->get();
    }

    public function getContractorCosts($id)
    {
        return Cost::join('users', 'costs.contractor_id', '=', 'users.id')
            ->select('costs.*', 'users.name', 'users.lastname')
            ->where('project_id', $id)
            ->where('contractor_id', '!=', null)
            ->get();
    }

    public function dividePercnets($request)
    {
        DB::transaction(function () use ($request) {
            foreach ($request->access as $key => $access)
                if (array_key_exists($key, $request->progress)) {
                    $percent = $request->progress[$key];
                    DB::table('project_contractor')
                        ->where('project_contractor.id', $access)
                        ->update(['progress_access' => $percent, 'progress' => '0']);
                }
            DB::table('projects')
                ->where('id', $request->project_id)
                ->update(['status' => 'ongoing']);
        });
    }

    public function getProgress($contractorData)
    {
        $allProgress = 0;
        foreach ($contractorData['contractors'] as $contractor) {
            $percent = $contractor->progress_access / 100;
            $progress = $contractor->progress * $percent;
            $allProgress += $progress;
        }
        $allProgress = round($allProgress, 0);
        return $allProgress;
    }

    public function deleteFullProject($projectId)
    {
        DB::transaction(function () use ($projectId) {
            $this->deleteTaskMaster($projectId);
            $this->deleteContractors($projectId);
            $this->deleteCategories($projectId);
            $this->deleteProject($projectId);
        });
    }

    public function updateTaskMaster($taskmasterId, $request)
    {
        $fileds = [
            'name' => $request->name,
            'lastname' => $request->lastname,
            'father_name' => $request->father_name,
            'meli_code' => $request->meli_code,
            'meli_image' => 'default',
            'phone' => $request->phone,
            'address' => $request->address,
        ];
        return DB::table('project_taskmaster')
            ->where('id', $taskmasterId)
            ->update($fileds);
    }

    public function updateProject($projectId, $request)
    {
        $dateStart = $this->convertToGregorian($request->date_start);
        $completedAt = $this->convertToGregorian($request->completed_at);
        $contractStarted = $this->convertToGregorian($request->contract_started);
        $dateTime = date('Y:m:d h:m:s');
        $fileds = [
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'contract_image' => 'Default',
            'contract_started' => $contractStarted,
            'contract_ended' => $completedAt,
            'date_start' => $dateStart,
            'complete_after' => $request->complete_after,
            'updated_at' => $dateTime,
        ];

        return DB::table('projects')
            ->where('id', $projectId)
            ->update($fileds);
    }

    public function updateProjectFull($projectId, $request)
    {
        DB::transaction(function () use ($projectId, $request) {
            $project = Project::findorFail($projectId);
            $this->updateTaskMaster($project->taskmaster, $request);
            $this->updateProject($project->id, $request);
        });
    }

    public function getMainCategories()
    {
        return Category::where('child', '!=', '0')->get();
    }
    public function getContractors()
    {
        return User::where('type', 'contractor')->get();
    }
}
