<?php

declare(strict_types=1);

namespace App\Testing\Application\Query\DTO\Test;

use App\Testing\Domain\Aggregate\Test\Question;
use App\Testing\Domain\Aggregate\Test\Test;

class TestDTO
{
    /**
     * @param QuestionDTO[] $questions
     */
    public function __construct(
        public readonly string $id,
        public readonly string $creatorId,
        public readonly string $name,
        public readonly string $description,
        public readonly string $difficultyLevel,
        public readonly array $questions,
        public readonly int $correctAnswersPercentage,
        public readonly string $skillId,
        public readonly bool $isPublished,
    ) {
    }

    public static function fromEntity(Test $test): self
    {
        $questions = array_map(
            fn (Question $question) => QuestionDTO::fromEntity($question),
            $test->getQuestions()->toArray()
        );

        return new self(
            id: $test->getId(),
            creatorId: $test->getOwnerId(),
            name: $test->getName(),
            description: $test->getDescription(),
            difficultyLevel: $test->getDifficultyLevel()->value,
            questions: $questions,
            correctAnswersPercentage: $test->getCorrectAnswersPercentage(),
            skillId: $test->getSkillId(),
            isPublished: $test->published(),
        );
    }
}
